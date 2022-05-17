const form = document.getElementById('form');
const firstname = document.getElementById('firstname');
const lastname = document.getElementById('lastname')
//const email = document.getElementById('email');
const dob = document.getElementById('dob');
const gender = document.getElementById('gender');

form.addEventListener('submit', e => {
	e.preventDefault();
	
	checkInputs();
});

function checkInputs() {
	// trim to remove the whitespaces
	const firstnameValue = firstname.value.trim();
	//const emailValue = email.value.trim();
	const lastnameValue = lastname.value.trim();
	const dobValue = dob.value.trim();
    const genderValue = gender.value.trim()
	
	if(firstnameValue === '') {
		setErrorFor(firstname, 'First name cannot be blank');
	} else {
		setSuccessFor(firstname);
	}
	
	// if(emailValue === '') {
	// 	setErrorFor(email, 'Email cannot be blank');
	// } else if (!isEmail(emailValue)) {
	// 	setErrorFor(email, 'Not a valid email');
	// } else {
	// 	setSuccessFor(email);
	// }
	
	if(lastnameValue === '') {
		setErrorFor(lastname, 'Last name cannot be blank');
	} else {
		setSuccessFor(lastname);
	}
	
	if (dobValue === '') {
        setErrorFor(dob, 'date of birth cannot be blank')
        
    }else{
        setSuccessFor(dob)
    }
if (genderValue ==='') {
    setErrorFor(gender, 'gender cannot be black')
}
else{
    setSuccessFor(gender)
}
}

function setErrorFor(input, message) {
	const formControl = input.parentElement;
	const small = formControl.querySelector('small');
	formControl.className = 'form-control error';
	small.innerText = message;
}

function setSuccessFor(input) {
	const formControl = input.parentElement;
	formControl.className = 'form-control success';
}
	
function isEmail(email) {
	return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}

