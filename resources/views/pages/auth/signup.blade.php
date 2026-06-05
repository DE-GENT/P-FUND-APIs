<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/jpeg" href="{{ asset('assets/images/project logo.jpeg') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>P-FUNDS || Registration</title>
    <!-- Google Fonts: Inter for typography -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- FontAwesome for robust icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Project Main Stylesheet -->
    <link rel="stylesheet" href="{{ asset('dist/styles/index.css') }}">
</head>

<body class="signup-body">
    <!-- Main page wrapper to center content -->
    <div class="signup-page-container">

        <!-- Center Header: Logo and Tagline -->
        <header class="main-header signup-header">
            <!-- Project logo image placed directly from assets mapping to user request -->
            <img src="{{ asset('assets/images/project logo.jpeg') }}" alt="P-FUNDS Logo">
            <p>ESTABLISHING INSTITUTIONAL TRUST</p>
        </header>

        <!-- Registration Content Layout Container (Flexbox for side-by-side) -->
        <main class="signup-content-wrapper">

            <!-- Left Sidebar: Verification Status Timeline -->
            <aside class="status-panel">
                <h3 class="panel-title">Verification Status</h3>

                <div class="timeline">
                    <!-- Step 1 (Current Active Step) -->
                    <div class="timeline-step active">
                        <div class="step-indicator">1</div>
                        <div class="step-content">
                            <h4>Identity Profile</h4>
                            <p>Submit your personal credentials for initial vetting.</p>
                        </div>
                    </div>

                    <!-- Step 2 (Pending Inactive Step) -->
                    <div class="timeline-step inactive">
                        <div class="step-indicator">2</div>
                        <div class="step-content">
                            <h4>Email OTP</h4>
                            <p>Requires institutional domain verification.</p>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Right Area: The Institutional Enrollment Form -->
            <section class="enrollment-panel">
                <!-- Enrollment Heading -->
                <div class="panel-header">
                    <h2>Institutional Enrollment</h2>
                    <p>Provide accurate legal information to initiate the vetting process for the Project Vault.</p>
                </div>

                <!-- Registration Form Block -->
                <form  id="registrationForm" action="#" method="POST" class="enrollment-form">

                    <!-- Full Width Field: Legal Name -->
                    <div class="form-group full-width">
                        <label>FULL LEGAL NAME</label>
                        <input  id="name" type="text" placeholder="As it appears on your passport">
                        <span class="helper-text">Enter first, middle, and last names.</span>
                    </div>

                    <!-- CSS Grid Layout Wrapper to split elements into 2 equal columns -->
                    <div class="form-grid">

                        <!-- Col 1: Email Address with Info Shield -->
                        <div class="form-group">
                            <label>EMAIL ADDRESS</label>
                            <input  id="email" type="email" placeholder="institutional@domain.com">
                            <span class="priority-note">
                                <i class="fa-solid fa-shield-halved"></i> Professional domains prioritized
                            </span>
                        </div>

                        <!-- Col 2: Phone Number -->
                        <div class="form-group">
                            <label>PHONE NUMBER</label>
                            <input  id="phone" type="tel" placeholder="+1 (000) 000-0000">
                        </div>

                        <!-- Col 1: Nationality Selector Dropdown -->
                        <div class="form-group">
                            <label>NATIONALITY</label>
                            <div class="select-wrapper">
                                <select id="nationality" name="nationality">
                                    <option value="" disabled selected>Select Jurisdiction</option>
                                    <option value="AF">Afghanistan</option>
                                    <option value="AL">Albania</option>
                                    <option value="DZ">Algeria</option>
                                    <option value="AD">Andorra</option>
                                    <option value="AO">Angola</option>
                                    <option value="AG">Antigua and Barbuda</option>
                                    <option value="AR">Argentina</option>
                                    <option value="AM">Armenia</option>
                                    <option value="AU">Australia</option>
                                    <option value="AT">Austria</option>
                                    <option value="AZ">Azerbaijan</option>
                                    <option value="BS">Bahamas</option>
                                    <option value="BH">Bahrain</option>
                                    <option value="BD">Bangladesh</option>
                                    <option value="BB">Barbados</option>
                                    <option value="BY">Belarus</option>
                                    <option value="BE">Belgium</option>
                                    <option value="BZ">Belize</option>
                                    <option value="BJ">Benin</option>
                                    <option value="BT">Bhutan</option>
                                    <option value="BO">Bolivia</option>
                                    <option value="BA">Bosnia and Herzegovina</option>
                                    <option value="BW">Botswana</option>
                                    <option value="BR">Brazil</option>
                                    <option value="BN">Brunei</option>
                                    <option value="BG">Bulgaria</option>
                                    <option value="BF">Burkina Faso</option>
                                    <option value="BI">Burundi</option>
                                    <option value="CV">Cabo Verde</option>
                                    <option value="KH">Cambodia</option>
                                    <option value="CM">Cameroon</option>
                                    <option value="CA">Canada</option>
                                    <option value="CF">Central African Republic</option>
                                    <option value="TD">Chad</option>
                                    <option value="CL">Chile</option>
                                    <option value="CN">China</option>
                                    <option value="CO">Colombia</option>
                                    <option value="KM">Comoros</option>
                                    <option value="CG">Congo (Brazzaville)</option>
                                    <option value="CD">Congo (Kinshasa)</option>
                                    <option value="CR">Costa Rica</option>
                                    <option value="CI">Côte d'Ivoire</option>
                                    <option value="HR">Croatia</option>
                                    <option value="CU">Cuba</option>
                                    <option value="CY">Cyprus</option>
                                    <option value="CZ">Czechia (Czech Republic)</option>
                                    <option value="DK">Denmark</option>
                                    <option value="DJ">Djibouti</option>
                                    <option value="DM">Dominica</option>
                                    <option value="DO">Dominican Republic</option>
                                    <option value="EC">Ecuador</option>
                                    <option value="EG">Egypt</option>
                                    <option value="SV">El Salvador</option>
                                    <option value="GQ">Equatorial Guinea</option>
                                    <option value="ER">Eritrea</option>
                                    <option value="EE">Estonia</option>
                                    <option value="SZ">Eswatini</option>
                                    <option value="ET">Ethiopia</option>
                                    <option value="FJ">Fiji</option>
                                    <option value="FI">Finland</option>
                                    <option value="FR">France</option>
                                    <option value="GA">Gabon</option>
                                    <option value="GM">Gambia</option>
                                    <option value="GE">Georgia</option>
                                    <option value="DE">Germany</option>
                                    <option value="GH">Ghana</option>
                                    <option value="GR">Greece</option>
                                    <option value="GD">Grenada</option>
                                    <option value="GT">Guatemala</option>
                                    <option value="GN">Guinea</option>
                                    <option value="GW">Guinea-Bissau</option>
                                    <option value="GY">Guyana</option>
                                    <option value="HT">Haiti</option>
                                    <option value="HN">Honduras</option>
                                    <option value="HU">Hungary</option>
                                    <option value="IS">Iceland</option>
                                    <option value="IN">India</option>
                                    <option value="ID">Indonesia</option>
                                    <option value="IR">Iran</option>
                                    <option value="IQ">Iraq</option>
                                    <option value="IE">Ireland</option>
                                    <option value="IL">Israel</option>
                                    <option value="IT">Italy</option>
                                    <option value="JM">Jamaica</option>
                                    <option value="JP">Japan</option>
                                    <option value="JO">Jordan</option>
                                    <option value="KZ">Kazakhstan</option>
                                    <option value="KE">Kenya</option>
                                    <option value="KI">Kiribati</option>
                                    <option value="KP">Korea (North)</option>
                                    <option value="KR">Korea (South)</option>
                                    <option value="KW">Kuwait</option>
                                    <option value="KG">Kyrgyzstan</option>
                                    <option value="LA">Laos</option>
                                    <option value="LV">Latvia</option>
                                    <option value="LB">Lebanon</option>
                                    <option value="LS">Lesotho</option>
                                    <option value="LR">Liberia</option>
                                    <option value="LY">Libya</option>
                                    <option value="LI">Liechtenstein</option>
                                    <option value="LT">Lithuania</option>
                                    <option value="LU">Luxembourg</option>
                                    <option value="MG">Madagascar</option>
                                    <option value="MW">Malawi</option>
                                    <option value="MY">Malaysia</option>
                                    <option value="MV">Maldives</option>
                                    <option value="ML">Mali</option>
                                    <option value="MT">Malta</option>
                                    <option value="MH">Marshall Islands</option>
                                    <option value="MR">Mauritania</option>
                                    <option value="MU">Mauritius</option>
                                    <option value="MX">Mexico</option>
                                    <option value="FM">Micronesia</option>
                                    <option value="MD">Moldova</option>
                                    <option value="MC">Monaco</option>
                                    <option value="MN">Mongolia</option>
                                    <option value="ME">Montenegro</option>
                                    <option value="MA">Morocco</option>
                                    <option value="MZ">Mozambique</option>
                                    <option value="MM">Myanmar (Burma)</option>
                                    <option value="NA">Namibia</option>
                                    <option value="NR">Nauru</option>
                                    <option value="NP">Nepal</option>
                                    <option value="NL">Netherlands</option>
                                    <option value="NZ">New Zealand</option>
                                    <option value="NI">Nicaragua</option>
                                    <option value="NE">Niger</option>
                                    <option value="NG">Nigeria</option>
                                    <option value="MK">North Macedonia</option>
                                    <option value="NO">Norway</option>
                                    <option value="OM">Oman</option>
                                    <option value="PK">Pakistan</option>
                                    <option value="PW">Palau</option>
                                    <option value="PA">Panama</option>
                                    <option value="PG">Papua New Guinea</option>
                                    <option value="PY">Paraguay</option>
                                    <option value="PE">Peru</option>
                                    <option value="PH">Philippines</option>
                                    <option value="PL">Poland</option>
                                    <option value="PT">Portugal</option>
                                    <option value="QA">Qatar</option>
                                    <option value="RO">Romania</option>
                                    <option value="RU">Russia</option>
                                    <option value="RW">Rwanda</option>
                                    <option value="KN">Saint Kitts and Nevis</option>
                                    <option value="LC">Saint Lucia</option>
                                    <option value="VC">Saint Vincent and the Grenadines</option>
                                    <option value="WS">Samoa</option>
                                    <option value="SM">San Marino</option>
                                    <option value="ST">Sao Tome and Principe</option>
                                    <option value="SA">Saudi Arabia</option>
                                    <option value="SN">Senegal</option>
                                    <option value="RS">Serbia</option>
                                    <option value="SC">Seychelles</option>
                                    <option value="SL">Sierra Leone</option>
                                    <option value="SG">Singapore</option>
                                    <option value="SK">Slovakia</option>
                                    <option value="SI">Slovenia</option>
                                    <option value="SB">Solomon Islands</option>
                                    <option value="SO">Somalia</option>
                                    <option value="ZA">South Africa</option>
                                    <option value="SS">South Sudan</option>
                                    <option value="ES">Spain</option>
                                    <option value="LK">Sri Lanka</option>
                                    <option value="SD">Sudan</option>
                                    <option value="SR">Suriname</option>
                                    <option value="SE">Sweden</option>
                                    <option value="CH">Switzerland</option>
                                    <option value="SY">Syria</option>
                                    <option value="TW">Taiwan</option>
                                    <option value="TJ">Tajikistan</option>
                                    <option value="TZ">Tanzania</option>
                                    <option value="TH">Thailand</option>
                                    <option value="TL">Timor-Leste</option>
                                    <option value="TG">Togo</option>
                                    <option value="TO">Tonga</option>
                                    <option value="TT">Trinidad and Tobago</option>
                                    <option value="TN">Tunisia</option>
                                    <option value="TR">Turkey</option>
                                    <option value="TM">Turkmenistan</option>
                                    <option value="TV">Tuvalu</option>
                                    <option value="UG">Uganda</option>
                                    <option value="UA">Ukraine</option>
                                    <option value="AE">United Arab Emirates</option>
                                    <option value="GB">United Kingdom</option>
                                    <option value="US">United States</option>
                                    <option value="UY">Uruguay</option>
                                    <option value="UZ">Uzbekistan</option>
                                    <option value="VU">Vanuatu</option>
                                    <option value="VA">Vatican City</option>
                                    <option value="VE">Venezuela</option>
                                    <option value="VN">Vietnam</option>
                                    <option value="YE">Yemen</option>
                                    <option value="ZM">Zambia</option>
                                    <option value="ZW">Zimbabwe</option>
                                </select>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                        </div>

                        <!-- Col 2: Address Field -->
                        <div class="form-group">
                            <label>ADDRESS</label>
                            <input id="address" placeholder="City, Country">
                        </div>

                        <!-- Col 1: Field of Specialty -->
                        <div class="form-group">
                            <label>FIELD OF SPECIALTY</label>
                            <input id="field_of_specialty" type="text" placeholder="City, Country">
                            <!-- The design mock identically puts 'City, Country' here -->
                        </div>

                        <!-- Col 2: Education Level Select -->
                        <div class="form-group">
                            <label>LEVEL OF EDUCATION <span class="optional">(Optional)</span></label>
                            <div class="select-wrapper">
                                <select id="education_level" name="education_level">
                                    <option value="phd" selected>PhD / Doctorate</option>
                                    <option value="masters">Master's Degree</option>
                                    <option value="bachelors">Bachelor's Degree</option>
                                </select>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                        </div>

                        <!-- Col 1: Password Input with Visible Eye Icon and Strength Meter -->
                        <div class="form-group">
                            <label>ACCESS PASSWORD</label>
                            <div class="password-wrapper">
                                <input id="password" type="password" placeholder="Min. 12 characters">
                                <i class="fa-regular fa-eye toggle-password"></i>
                            </div>
                            <div class="password-strength">
                                <div class="strength-bars">
                                    <div class="bar active"></div>
                                    <div class="bar active"></div>
                                    <div class="bar active"></div>
                                    <div class="bar inactive"></div>
                                </div>
                                <span class="strength-text">Institutional Grade Strength</span>
                            </div>
                        </div>

                        <!-- Col 2: Confirmed Password Input -->
                        <div class="form-group">
                            <label>CONFIRM ACCESS PASSWORD</label>
                            <input id="password_confirmation" type="password" placeholder="Must match exactly">
                            <span id="password-match-error" style="color: #e74c3c; font-size: 12px; display: none; margin-top: 5px;"><i class="fa-solid fa-circle-exclamation"></i> Passwords do not match</span>
                        </div>
                    </div> <!-- End of Form Grid -->

                    <!-- Aesthetic Divider line -->
                    <hr class="form-divider">

                    <!-- Form Footer layout for Checkbox and Button -->
                    <div class="form-footer">
                        <!-- Checkbox Legal Consent Item -->
                        <label class="checkbox-container signup-checkbox">
                            <input id="consent" type="checkbox">
                            <span class="terms-text">
                                I attest that the provided data is legally accurate and I consent to the <a
                                    href="#">Institutional Vetting Protocol</a> and Privacy Charter.
                            </span>
                        </label>

                        <!-- Proceed Action Button -->
                        <button type="button" class="submit-btn registration-btn">
                            INITIATE<br>REGISTRATION
                        </button>
                    </div>

                </form> <!-- End of Registration Form -->
            </section>
        </main> <!-- End Content Wrapper -->

    </div>
<!-- Link to the JavaScript file for form interactions -->
    <script>
        // --- UI Interactions ---
        // 1. Toggle Password Visibility
        const togglePassword = document.querySelector('.toggle-password');
        const passwordInput = document.getElementById('password');

        togglePassword.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });

        // 2. Password Strength Meter
        const strengthBars = document.querySelectorAll('.strength-bars .bar');
        const strengthText = document.querySelector('.strength-text');

        // Set initial state
        strengthBars.forEach(bar => { bar.classList.remove('active'); bar.classList.add('inactive'); });
        strengthText.textContent = '';

        passwordInput.addEventListener('input', function() {
            const val = passwordInput.value;
            let strength = 0;
            
            if (val.length > 0) strength += 1;
            if (val.length >= 8) strength += 1;
            if (/[A-Z]/.test(val) && /[0-9]/.test(val)) strength += 1;
            if (/[^A-Za-z0-9]/.test(val) && val.length >= 10) strength += 1;

            strengthBars.forEach((bar, index) => {
                if (index < strength) {
                    bar.classList.add('active');
                    bar.classList.remove('inactive');
                } else {
                    bar.classList.remove('active');
                    bar.classList.add('inactive');
                }
            });

            if (strength === 0) strengthText.textContent = '';
            else if (strength === 1) { strengthText.textContent = 'Weak'; strengthText.style.color = '#e74c3c'; }
            else if (strength === 2) { strengthText.textContent = 'Fair'; strengthText.style.color = '#f1c40f'; }
            else if (strength === 3) { strengthText.textContent = 'Good'; strengthText.style.color = '#3498db'; }
            else if (strength === 4) { strengthText.textContent = 'Institutional Grade Strength'; strengthText.style.color = '#2ecc71'; }
        });

        // 3. Confirm Password Validation
        const confirmPasswordInput = document.getElementById('password_confirmation');
        const matchError = document.getElementById('password-match-error');

        function validatePasswordMatch() {
            if (confirmPasswordInput.value === '') {
                matchError.style.display = 'none';
                confirmPasswordInput.style.borderColor = '';
            } else if (passwordInput.value !== confirmPasswordInput.value) {
                matchError.style.display = 'block';
                confirmPasswordInput.style.borderColor = '#e74c3c';
            } else {
                matchError.style.display = 'none';
                confirmPasswordInput.style.borderColor = '#2ecc71';
            }
        }

        passwordInput.addEventListener('input', validatePasswordMatch);
        confirmPasswordInput.addEventListener('input', validatePasswordMatch);

        // --- Form Submission Logic ---
        document.querySelector('.registration-btn').addEventListener('click', async function () {

       // Check consent checkbox first
           const consent = document.getElementById('consent').checked;
           if (!consent) {
               alert('Please agree to the Institutional Vetting Protocol before proceeding.');
               return;
           }
   
           // collect all form values
           const payload = {
               name:               document.getElementById('name').value,
               email:              document.getElementById('email').value,
               phone:              document.getElementById('phone').value,
               nationality:        document.getElementById('nationality').value,
               address:            document.getElementById('address').value,
               field_of_specialty: document.getElementById('field_of_specialty').value,
               education_level:    document.getElementById('education_level').value,
               password:           document.getElementById('password').value,
               password_confirmation: document.getElementById('password_confirmation').value,
           };
           console.log('Sending payload:', JSON.stringify(payload));
   
           try {
               const response = await fetch('http://127.0.0.1:8000/api/v1/auth/register', {
                   method: 'POST',
                   headers: {
                       'Content-Type': 'application/json',
                       'Accept':       'application/json',
                   },
                   body: JSON.stringify(payload),
               });
   
               const data = await response.json();
               console.log('Server response:', JSON.stringify(data));
               
               if (data.success) {
                   // save token and user to localStorage
                    localStorage.setItem('auth_token', data.data.token);
                    localStorage.setItem('pfunds_token', data.data.token);
                    localStorage.setItem('user', JSON.stringify(data.data.user));
                    localStorage.setItem('pfunds_user', JSON.stringify(data.data.user));
                    localStorage.setItem('user_email', data.data.user.email);
   
                   alert('Registration successful! Redirecting...');
                   // redirect to dashboard or next step
                   window.location.href = "{{ route('otp') }}";
               } else {
                   console.error('Registration errors:', data.errors);
                   // show first error message
                   const firstError = Object.values(data.errors)[0][0];
                   alert('Error: ' + firstError);
               }
   
           } catch (error) {
               alert('Could not connect to server. Make sure Laravel is running.');
               console.error(error);
           }
       });
   </script>

   664235





</body>

</html>