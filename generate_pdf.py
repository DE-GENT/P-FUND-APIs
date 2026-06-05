import os
import re
from fpdf import FPDF

class ProjectDefensePDF(FPDF):
    def __init__(self):
        super().__init__()
        # Set margins: left=20mm, top=20mm, right=20mm
        self.set_margins(20, 20, 20)
        self.set_auto_page_break(auto=True, margin=20)
        
    def header(self):
        if self.page_no() == 1:
            # Skip header on the cover page
            return
        self.set_font('helvetica', 'B', 8)
        self.set_text_color(100, 116, 139) # slate-500
        self.cell(0, 10, 'P-FUNDS | Project Defense & Technical Architecture Guide', border=0, align='L')
        # Add a thin line under header
        self.set_draw_color(226, 232, 240) # slate-200
        self.line(20, 30, 190, 30)
        self.ln(12)

    def footer(self):
        self.set_y(-15)
        self.set_font('helvetica', 'I', 8)
        self.set_text_color(148, 163, 184) # slate-400
        self.cell(0, 10, f'Page {self.page_no()}', border=0, align='C')

    def cover_page(self):
        self.add_page()
        
        # Draw a beautiful dark slate border left accent
        self.set_fill_color(30, 41, 59) # slate-800
        self.rect(20, 50, 4, 150, 'F')
        
        # Title Group
        self.set_xy(28, 60)
        self.set_font('helvetica', 'B', 38)
        self.set_text_color(30, 41, 59) # slate-800
        self.cell(0, 15, 'P-FUNDS', ln=1)
        
        self.set_x(28)
        self.set_font('helvetica', 'B', 18)
        self.set_text_color(124, 58, 237) # purple-600
        self.cell(0, 12, 'Professional Project Funding', ln=1)
        
        self.set_x(28)
        self.set_font('helvetica', 'B', 18)
        self.set_text_color(30, 41, 59)
        self.cell(0, 12, '& Milestone Verification Platform', ln=1)
        
        # Subtitle
        self.ln(25)
        self.set_x(28)
        self.set_font('helvetica', '', 12)
        self.set_text_color(71, 85, 105) # slate-600
        self.multi_cell(0, 7, 'A detailed technical architecture manual, directory mapping, '
                              'database schema, and mock examiner Q&A designed for '
                              'project defense preparation.')
        
        # Metadata block at bottom
        self.set_y(-50)
        self.set_x(28)
        self.set_font('helvetica', 'B', 10)
        self.set_text_color(30, 41, 59)
        self.cell(0, 6, 'Created For: Project Defense Panel', ln=1)
        
        self.set_x(28)
        self.set_font('helvetica', '', 10)
        self.set_text_color(100, 116, 139)
        self.cell(0, 6, 'Target Roles: Creator, Sponsor, Vetter, and Administrator', ln=1)
        
        self.set_x(28)
        self.cell(0, 6, 'Backend: PHP / Laravel 11 | Frontend: Vanilla JS / HTML5 / CSS3', ln=1)

def clean_text(text):
    # Replace unicode quotes and hyphens
    replacements = {
        '\u201c': '"',
        '\u201d': '"',
        '\u2018': "'",
        '\u2019': "'",
        '\u2014': '-',
        '\u2013': '-',
        '\u2500\u2500\u25ba': '-->',
        '\u2500\u2500\u2500\u25ba': '--->',
        '\u27a1': '->',
        '\u25c6': '*',
        '\ud83d\udc4b': '', # remove emoji Wave
        '\u2022': '*',
    }
    for orig, rep in replacements.items():
        text = text.replace(orig, rep)
    
    # Strip emojis or other high characters to prevent FPDF crash
    text = re.sub(r'[^\x00-\x7F]+', ' ', text)
    return text.strip()

def build_pdf_from_md(md_path, pdf_path):
    pdf = ProjectDefensePDF()
    pdf.cover_page()
    pdf.add_page()
    
    with open(md_path, 'r', encoding='utf-8') as f:
        lines = f.readlines()
        
    in_code_block = False
    code_lines = []
    
    for line in lines:
        cleaned_line = clean_text(line)
        
        # Check for code blocks
        if cleaned_line.startswith('```'):
            if in_code_block:
                # End of code block
                in_code_block = False
                pdf.set_font('courier', '', 9)
                pdf.set_text_color(15, 23, 42) # slate-900
                pdf.set_fill_color(248, 250, 252) # slate-50
                
                # Render code box
                code_text = '\n'.join(code_lines)
                pdf.multi_cell(0, 5, code_text, border=1, fill=True)
                pdf.ln(5)
                code_lines = []
            else:
                # Start of code block
                in_code_block = True
            continue
            
        if in_code_block:
            code_lines.append(cleaned_line)
            continue
            
        # Skip top document title since it is already on the cover page
        if cleaned_line.startswith('# ') and ('P-FUNDS:' in cleaned_line or 'Technical Architecture' in cleaned_line):
            continue
        if cleaned_line.startswith('## ') and 'Technical Architecture' in cleaned_line:
            continue
        if cleaned_line == '---' or cleaned_line == '':
            if cleaned_line == '---':
                pdf.ln(5)
            continue
            
        # Parse headings
        if cleaned_line.startswith('# '):
            pdf.ln(8)
            pdf.set_font('helvetica', 'B', 18)
            pdf.set_text_color(30, 41, 59) # slate-800
            title_text = cleaned_line.replace('# ', '')
            pdf.cell(0, 10, title_text, ln=1)
            pdf.ln(4)
            
        elif cleaned_line.startswith('## '):
            pdf.ln(6)
            pdf.set_font('helvetica', 'B', 13)
            pdf.set_text_color(124, 58, 237) # purple-600
            title_text = cleaned_line.replace('## ', '')
            pdf.cell(0, 8, title_text, ln=1)
            pdf.ln(2)
            
        elif cleaned_line.startswith('### '):
            pdf.ln(4)
            pdf.set_font('helvetica', 'B', 10)
            pdf.set_text_color(71, 85, 105) # slate-600
            title_text = cleaned_line.replace('### ', '')
            pdf.cell(0, 6, title_text, ln=1)
            pdf.ln(2)
            
        # Parse bullet lists
        elif cleaned_line.startswith('* ') or cleaned_line.startswith('- '):
            # Remove indicator
            bullet_text = cleaned_line[2:]
            
            # Format bold prefixes in bullet points (e.g. * **Title:** details)
            is_bold_prefix = False
            prefix_match = re.match(r'^\*\*(.*?)\*\*(.*)', bullet_text)
            
            pdf.set_font('helvetica', '', 10)
            pdf.set_text_color(51, 65, 85) # slate-700
            
            # Draw a nice clean bullet circle
            current_y = pdf.get_y()
            pdf.set_fill_color(124, 58, 237) # purple bullet
            pdf.ellipse(22, current_y + 2, 2.5, 2.5, 'F')
            
            pdf.set_x(28)
            if prefix_match:
                prefix = prefix_match.group(1)
                body = prefix_match.group(2)
                
                # Print bold prefix
                pdf.set_font('helvetica', 'B', 10)
                pdf.write(5, prefix)
                
                # Print body
                pdf.set_font('helvetica', '', 10)
                pdf.write(5, body + '\n')
            else:
                pdf.multi_cell(0, 5, bullet_text)
            pdf.ln(1.5)
            
        elif cleaned_line.startswith('1. ') or re.match(r'^\d+\.\s', cleaned_line):
            # Ordered list item
            num_match = re.match(r'^(\d+\.)\s(.*)', cleaned_line)
            num = num_match.group(1)
            body_text = num_match.group(2)
            
            pdf.set_x(20)
            pdf.set_font('helvetica', 'B', 10)
            pdf.write(5, num + ' ')
            
            # Check for bold prefixes inside body
            prefix_match = re.match(r'^\*\*(.*?)\*\*(.*)', body_text)
            if prefix_match:
                prefix = prefix_match.group(1)
                body = prefix_match.group(2)
                
                pdf.set_font('helvetica', 'B', 10)
                pdf.write(5, prefix)
                pdf.set_font('helvetica', '', 10)
                pdf.write(5, body + '\n')
            else:
                pdf.set_font('helvetica', '', 10)
                pdf.write(5, body_text + '\n')
            pdf.ln(1.5)
            
        # Parse Q&As specifically to format them beautifully
        elif cleaned_line.startswith('Q') and ':' in cleaned_line and ('Question' in cleaned_line or re.match(r'^Q\d+', cleaned_line)):
            pdf.ln(4)
            pdf.set_font('helvetica', 'B', 11)
            pdf.set_text_color(15, 23, 42) # slate-900
            pdf.multi_cell(0, 6, cleaned_line)
            pdf.ln(1)
            
        elif cleaned_line.startswith('Answer:') or cleaned_line.startswith('**Answer:**'):
            ans_text = cleaned_line.replace('**Answer:**', 'Answer:').replace('Answer:', '')
            pdf.set_font('helvetica', 'B', 10)
            pdf.set_text_color(124, 58, 237) # purple
            pdf.write(5, 'Answer:')
            pdf.set_font('helvetica', '', 10)
            pdf.set_text_color(51, 65, 85) # slate-700
            pdf.write(5, ans_text + '\n')
            pdf.ln(3)
            
        else:
            # Regular paragraph
            pdf.set_font('helvetica', '', 10)
            pdf.set_text_color(51, 65, 85) # slate-700
            pdf.multi_cell(0, 5, cleaned_line)
            pdf.ln(3.5)
            
    # Save the compiled PDF
    pdf.output(pdf_path)
    print(f"Successfully generated PDF: {pdf_path}")

if __name__ == '__main__':
    md_file = 'project_defense_guide.md'
    pdf_file = 'project_defense_guide.pdf'
    
    if os.path.exists(md_file):
        build_pdf_from_md(md_file, pdf_file)
    else:
        print(f"Error: {md_file} not found!")
