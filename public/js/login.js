function setupPasswordToggle(){

    const toggleBtn=document.querySelector('#togglePassword');
    const passwordInput = document.getElementById('password');

    if (!toggleBtn || !passwordInput) {
        console.error('Required elements not found!');
        return;
    }

    toggleBtn.addEventListener('click',function(){

        const icon = this.querySelector('i');

        if (!icon) {
            console.error('Icon element not found!');
            return;
        }
        if (passwordInput.type === 'password') {

            passwordInput.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {

            passwordInput.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }

    })

}

document.addEventListener('DOMContentLoaded',function (){
    setupPasswordToggle();
});
