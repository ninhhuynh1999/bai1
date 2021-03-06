var btnAdd = document.querySelector("#btn-add");
var btnSearch = document.querySelector("#btn-search");
var btnAll = document.querySelector("#btn-all");
var btnClearDate = document.querySelector("#btn-clear-date");
var searchField = document.querySelector(".search-field");

const listColumn = {
    name: 1,
    shortName: 2,
    phoneNumber: 3,
    note: 4,
    address: 5,
};

//Handle add row
btnAdd.addEventListener("click", (e) => {
    addRow();
});

//Search data when click
btnSearch.addEventListener("click", () => {
    var dataForm = $("#filter-form").serializeArray();
    var from_date = $("input[name='filter_from_date']").val();
    var to_date = $("input[name='filter_to_date']").val();
    var optionDate = $("select[name='filter_date_option']").val();

    console.log(from_date + "-" + to_date + "-" + optionDate);
    var table = load_data(from_date, to_date, optionDate);

    for (let index = 0; index < dataForm.length; index += 2) {
        filterData(dataForm[index]["value"], dataForm[index + 1]["value"]);
    }
});

//remove all filter and get all data
btnAll.addEventListener("click", () => {
    // var buttonHidden = $(".btn-hidden");

    // for (let index = 0; index < buttonHidden.length; index++) {
    //     hiddenRow(buttonHidden[index]);
    // }
    // $table.search("").draw();

    $("#shipping_table").DataTable().destroy();
    $(".search-field .row").remove();
    load_data();
});

btnClearDate.addEventListener('click',()=>{
//filter_from_date
    document.querySelector('input[name="filter_from_date"]').value=""
    document.querySelector('input[name="filter_to_date"]').value=""
})

//filter data by name columns
function filterData(nameCol, value) {
    var indexCol = listColumn[nameCol];
    if (value) {
        console.log(indexCol + "-" + value);

        $table.columns(indexCol).search(value).draw();
    }
}

//add row filter
function addRow() {
    numberRow = searchField.childElementCount;
    if (numberRow >= 3) {
        return;
    }
    searchField.insertAdjacentHTML("beforeend", rawHTML(numberRow + 1));
}

function hiddenRow(button) {
    // var rowDelete= button.parentElement.parentElement.parentElement.remove();
    var rowDelete = $(button).closest(".row");
    var filterRemove = $(rowDelete).find("select").val();

    rowDelete.remove();
    filterData(filterRemove, "");

    var numberChild = searchField.childElementCount;
    if (numberChild < 1) {
        return;
    }
    var titles = document.querySelectorAll(".filter-title");
    for (let index = 0; index < numberChild; index++) {
        titles[index].textContent = "Danh m???c " + (index + 1);
    }
}

// html for row filter
function rawHTML(index) {
    var htmlRaw = `<div class="row" style="">
<div class="col-sm-3">
   
    <label for=""> <span class='filter-title'>Danh m???c ${index}</span></label>

    <div class="form-group select-filter-shipping">
        <select name="filter${index}_select" class="form-control select2" style="width: 100%;">
            <option value="name" selected="" class="selected">T??n ??VVC</option>
            <option value="shortName">T??n vi???t t???t</option>
            <option value="address">?????a ch???</option>
            <option value="phoneNumber">S??? ??i???n tho???i</option>
            <option value="note">Ghi ch??</option>
        </select>
    </div>
</div>
<div class="col-sm-3">
    <label for=""><span>T??m ki???m</span></label>

    <div class="form-group input-filter-shipping">
        <input type="text" name="filter${index}_text" class="form-control" placeholder="Nh???p n???i dung t??m ki???m">
    </div>
</div>
<div class="col-sm-1">
    <div class="form-group">
        <button onclick="hiddenRow(this)"  class="form-control btn btn-danger btn-hidden"><i class="fa fa-times" aria-hidden="true"></i>
        </button>
    </div>

</div>
</div>`;
    return htmlRaw;
}
