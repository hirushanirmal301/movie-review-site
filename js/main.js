const dropUpButtons = document.querySelectorAll(".drop-up");

const scrollToTop = () => {
    window.scrollTo({
        top: 0,
        behavior: "smooth"
    });
};

dropUpButtons.forEach((button) => {
    button.addEventListener("click", scrollToTop);
});
