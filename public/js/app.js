window.onload = () => {
    let btn = document.querySelector('.toggleMore');
    btn.addEventListener("click", () => {
        if ( btn.parentElement.classList.contains("full"))
            btn.parentElement.classList.remove('full')
        else
            btn.parentElement.classList.add('full')
    })

}
