window.addEventListener("load", () => {
    const datePick = document.querySelector('input[name="dateStopContact"]');
    const status = document.querySelector('select[name="status_id"]');
    status.addEventListener("change", (e) => {
        if (e.target.value == "2") {
            console.log(e.target.value);
            datePick.setAttribute("disabled", "");
        } else {
            datePick.removeAttribute("disabled");
        }
    });
});
