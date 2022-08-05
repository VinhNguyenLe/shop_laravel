const innerVl = document.querySelector(".custom-get-value").innerText;
const customTbody = document.querySelector(".custom-tbody");
console.log(innerVl);

function addToTable(callback) {
    const htmls = callback.map((element) => {
        return `<tr>
      <td>${element[0]}</td>
      <td>${element[1]}</td>
    </tr>`;
    });
    console.log(htmls);
    customTbody.innerHTML = htmls.join("");
}

function stringToTable(params) {
    const firstArr = params.split("-");
    const secondArr = firstArr.filter((item) => item != "");
    const splitArr = secondArr.map((item) => {
        return item.split(":");
    });

    let keyArr = [];
    let valueArr = [];

    splitArr.forEach((element) => {
        keyArr.push(element[0]);
        valueArr.push(element[1]);
    });

    return splitArr;
}
addToTable(stringToTable(innerVl));
