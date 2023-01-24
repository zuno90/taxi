var citis = document.getElementById("city");
var districts = document.getElementById("district");
var wards = document.getElementById("ward");
document.addEventListener('DOMContentLoaded', () => {
citis.click();
districts.click();
}, false);
var Parameter = {
  url: urljson, 
  method: "GET", 
  responseType: "text", 
};
var promise = axios(Parameter);
promise.then(function (result) {
  renderCity(result.data);
});

function renderCity(data) {
  for (const x of data) {
	var opt = document.createElement('option');
	 opt.value = x.Name;
	 opt.text = x.Name;
	 opt.setAttribute('data-id', x.Id);
	 if (x.Name == adress1){
	 opt.setAttribute('selected', 'selected');
	 }
	 citis.options.add(opt);
  }
  citis.onclick = function () {
    district.length = 1;
    ward.length = 1;
    if(this.options[this.selectedIndex].dataset.id != ""){
      const result = data.filter(n => n.Id === this.options[this.selectedIndex].dataset.id);

      for (const k of result[0].Districts) {
		var opt = document.createElement('option');
		 opt.value = k.Name;
		 opt.text = k.Name;
		 opt.setAttribute('data-id', k.Id);
		 if (k.Name == adress2){
		 opt.setAttribute('selected', 'selected');
		 }
		 district.options.add(opt);
      }
    }
  };
  district.onclick = function () {
    ward.length = 1;
    const dataCity = data.filter((n) => n.Id === citis.options[citis.selectedIndex].dataset.id);
    if (this.options[this.selectedIndex].dataset.id != "") {
      const dataWards = dataCity[0].Districts.filter(n => n.Id === this.options[this.selectedIndex].dataset.id)[0].Wards;

      for (const w of dataWards) {
		var opt = document.createElement('option');
		 opt.value = w.Name;
		 opt.text = w.Name;
		 opt.setAttribute('data-id', w.Id);
		 if (w.Name == adress3){
		 opt.setAttribute('selected', 'selected');
		 }
		 wards.options.add(opt);
      }
    }
  };
}