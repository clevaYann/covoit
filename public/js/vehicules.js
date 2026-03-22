document.addEventListener("DOMContentLoaded", () => {
    const verifyButton = document.querySelector(".btn-verify");
    const input = document.querySelector("#verificationInput");
    const result = document.querySelector("#verificationResult");
    const rows = document.querySelectorAll(".vehicles-table tbody tr");

    if (!verifyButton || !input) {
        return;
    }

    verifyButton.addEventListener("click", (event) => {
        event.preventDefault();

        const searchedModel = input.value.trim().toLowerCase();

        const matchedRow = Array.from(rows).find((row) => {
            const modelCell = row.querySelector("td");
            if (!modelCell) {
                return false;
            }

            return modelCell.textContent.trim().toLowerCase() === searchedModel;
        });

        if (result) {
            result.textContent = searchedModel && matchedRow ? "Oui" : "Non";
        }
    });
});
