window.addEventListener("load", () => {
    const datePick = document.querySelector('input[name="dateStopContact"]');
    const status = document.querySelector('select[name="status_id"]');
    disableStatusDate(status)


    status.addEventListener("change", (e) => {
      disableStatusDate(e.target);
    });
    
    function disableStatusDate(element){
    if (element.value == "1") {
        datePick.setAttribute("disabled", "");
    } else {
        datePick.removeAttribute("disabled");
    }
}
});




