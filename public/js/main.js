
const dices = document.querySelectorAll(".dice");

dices.forEach(e => {
    e.addEventListener("click", e => {
        const lock = e.target.dataset.locked;

        if (lock === "true") {
            return false;
        }

        const diceNumber = e.target.dataset.diceNumber;
        const input = document.querySelector(`input[name="keep-dice-${diceNumber}"]`);

        if (e.target.classList.contains("selected")) {
            e.target.classList.remove("selected");
            input.value = "false";
        } else {
            e.target.classList.add("selected");
            input.value = "true";
        }
    });
});
