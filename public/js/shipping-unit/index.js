var btnAdd = document.querySelector("#btn-add");
var btnSearch = document.querySelector("#btn-search");
var btnAll = document.querySelector("#btn-all");
var searchField = document.querySelector(".search-field");

const listColumn = {
    name: 1,
    shortName: 2,
    phoneNumber: 3,
    note: 4,
    address: 5,
};
const listFilter = {
    name: 1,
    shortName: 2,
    phoneNumber: 3,
    note: 4,
    address: 5,
};
btnAdd.addEventListener("click", (e) => {
    addRow();
});

btnSearch.addEventListener("click", () => {
    var data = $("#filter-form").serializeArray();
    for (let index = 0; index < data.length; index += 2) {
        filterData(data[index]["value"], data[index + 1]["value"]);
    }
});

btnAll.addEventListener("click", () => {
    var buttonHidden = $(".btn-hidden");

    for (let index = 0; index < buttonHidden.length; index++) {
        hiddenRow(buttonHidden[index]);
    }
    $table.search("").draw();
});

function filterData(nameCol, value) {
    var indexCol = listColumn[nameCol];

    console.log(indexCol + "-" + value);

    $table.columns(indexCol).search(value).draw();
}

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
        titles[index].textContent = "Danh mục " + (index + 1);
    }
}

function rawHTML(index) {
    var htmlRaw = `<div class="row" style="">
<div class="col-sm-3">
   
    <label for=""> <span class='filter-title'>Danh mục ${index}</span></label>

    <div class="form-group select-filter-shipping">
        <select name="filter${index}_select" class="form-control select2" style="width: 100%;">
            <option value="name" selected="" class="selected">Tên ĐVVC</option>
            <option value="shortName">Tên viết tắt</option>
            <option value="address">Địa chỉ</option>
            <option value="phoneNumber">Số điện thoại</option>
            <option value="note">Ghi chú</option>
        </select>
    </div>
</div>
<div class="col-sm-3">
    <label for=""><span>Tìm kiếm</span></label>

    <div class="form-group input-filter-shipping">
        <input type="text" name="filter${index}_text" class="form-control" placeholder="Nhập nội dung tìm kiếm">
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

$(document).ready(function () {
    // Setup - add a text input to each footer cell
  
});
