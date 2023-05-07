function opensearch(){
	let searchbar = document.getElementById("searchbar");
	if(searchbar){
		if(searchbar.style.display == "none"){
			searchbar.style.display = "inline-block";
			searchbar.focus();
		}
		else
			searchbar.style.display = "none";
	}
	else{
		document.getElementsByTagName("body")[0].innerHTML +=
		"<input type=\"search\" id=\"searchbar\" placeholder=\"Пошук\" onkeypress=\"handle(event)\">";
		document.getElementById("searchbar").focus();
	}
}

function handle(e){
	if(e.key === "Enter"){
		let searchbar = document.getElementById("searchbar");
		if(searchbar.value.trim().length != 0)
			window.location.href = "search-page.php?query="+searchbar.value.trim().toLowerCase();
	}
}

function catalogue_scroll(elem, k){
	let div = elem.parentElement.getElementsByTagName("div")[0];

	let i = 0;
	const interval = setInterval(function (){
		div.scrollLeft += 5*k;
		i+=5;
		if(i >= 150)
			clearInterval(interval);
	}, 3);
}

function show_filters(){
	let filter_form = document.getElementsByClassName("filter-form")[0];
	let div = filter_form.getElementsByTagName("div")[0];
	let hr = filter_form.getElementsByTagName("hr")[0];

	if(div.style.display == "block"){
		div.style.display = "none";
		hr.style.marginBottom = "-22px";
	}
	else{
		div.style.display = "block";
		hr.style.marginBottom = "20px";
	}
}

function show_product_card(elem){
	let card = document.getElementsByClassName("card-bg")[0];
	if(card.style.display == "flex")
		card.style.display = "none";
	else{
		card.style.display = "flex";

		let p1 = elem.parentElement;
		let p2 = p1.parentElement;
		let p3 = p2.parentElement;

		let name = p1.getElementsByTagName("h3")[0].innerHTML;
		let descr = p2.getElementsByClassName("product-item-descr")[0].innerHTML;
		let os = p2.getElementsByClassName("product-item-os")[0].innerHTML;
		let img_src = p3.getElementsByTagName("img")[0].src;
 		
 		let forsale = false;
		if(name.includes("<b style=\"color: red;\"> %</b>")){
			forsale = true;
			name = name.replace("<b style=\"color: red;\"> %</b>", "");
		}

		card.getElementsByTagName("h1")[0].innerHTML = name;
		card.getElementsByClassName("card-full-info")[0].innerHTML = descr + "<br><br>ОС: " + os + "<br><br>";
		if(forsale)
			card.getElementsByClassName("card-full-info")[0].innerHTML += "<b style=\"color: red;\">Знижка!</b>";

		card.getElementsByTagName("img")[0].src = img_src;
	}
}

function close_product_card(){
	document.getElementsByClassName("card-bg")[0].style.display = "none";
}


function change_adm_panel_tab(n){
	let btn = document.getElementsByClassName("admin-panel-tabs")[0].getElementsByTagName("button");
	btn[0].style.background = "";
	btn[1].style.background = "";
	btn[2].style.background = "";
	btn[n].style.background = "#ddd";

	if(n == 0){
		document.getElementsByClassName("admin-panel-welc")[0].style.display = "block";
		document.getElementsByTagName("form")[0].style.display = "none";
		document.getElementsByTagName("form")[1].style.display = "none";	
	}
	else if(n == 1){
		document.getElementsByClassName("admin-panel-welc")[0].style.display = "none";
		document.getElementsByTagName("form")[0].style.display = "block";
		document.getElementsByTagName("form")[1].style.display = "none";	
	}
	else if(n == 2){
		document.getElementsByClassName("admin-panel-welc")[0].style.display = "none";
		document.getElementsByTagName("form")[0].style.display = "none";
		document.getElementsByTagName("form")[1].style.display = "block";	
	}

}