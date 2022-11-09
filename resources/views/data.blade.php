<html>
<head>
    <link href="https://unpkg.com/tabulator-tables@5.4.2/dist/css/tabulator_site.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>

    <script type="text/javascript" src="https://unpkg.com/tabulator-tables@5.4.2/dist/js/tabulator.min.js"></script>
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<!--<div>-->
<!--    <select id="filter-field">-->
<!--        <option></option>-->
<!--        <option value="status" selected>status</option>-->
<!--        <option value="bookingId">bookingId</option>-->
<!--        <option value="bookingId2">bookingId2</option>-->
<!--        <option value="sender">sender</option>-->
<!--        <option value="sender2">sender2</option>-->
<!--        <option value="title">title</option>-->
<!--        <option value="language">language</option>-->
<!--    </select>-->

<!--    <select id="filter-type">-->
<!--        <option value="=">=</option>-->
<!--        <option value="<"><</option>-->
<!--        <option value="<="><=</option>-->
<!--        <option value=">">></option>-->
<!--        <option value=">=">>=</option>-->
<!--        <option value="!=">!=</option>-->
<!--        <option value="like">like</option>-->
<!--    </select>-->

<!--    <input id="filter-value" type="text" placeholder="value to filter">-->

<!--    <button id="filter-clear">Clear Filter</button>-->
<!--</div>-->
	
	<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
    </div>
    <ul class="nav navbar-nav">
    		  <li  id="add-row" class="active"><a href="#">Insert a new row</a></li>
		      <li   class="active"><a href="#">Add selected row</a></li>

		      <li   class="active"><a href="#">Update selected row</a></li>

    </ul>
  </div>
</nav>
<div id="example-table"></div>
<h1>Today's Reservations</h1>
<div id="today-table"></div>
</html>
<script>
    function statusBackground(cell, formatterParams) {
        var value = cell.getValue();
        if (value == "CANCELED") {
            cell.getRow().getElement().style.backgroundColor = "#FF0000";

            return value;
        }

        else if (value == "MODIFIED") {
            cell.getRow().getElement().style.backgroundColor = "#FFFF00";

            return value;
        } else {
            return value;
        }
    }
	
	    function shortName(cell, formatterParams) {
        var value = cell.getValue();
        if (value.includes("Rena")) {
            return "<p>" + "RENAISSANCE" + "</p>"; 
        }

        else if (value.includes("Curiosidades")) {
           return "<p>" + "RENAISSANCE" + "</p>"; 
        }
		 else if (value.includes("Curiosities")) {
           return "<p>" + "RENAISSANCE" + "</p>"; 
        }	
			
			 else if (value.includes("Free Tour a Pie por Florencia a las")) {
             return "<p>" + "RENAISSANCE" + "</p>"; 
        }	
			
			 else if (value.includes("Free Tour Florencia")) {
           return "<p>" + "RENAISSANCE" + "</p>"; 
        }	
			 else if (value.toLowerCase().includes("florence free walking tour at")) {
               return "<p>" + "RENAISSANCE" + "</p>"; 
        }
				
			 else if (value.includes("Florence Hidden Gems")) {
              return "<p>" + "RENAISSANCE" + "</p>"; 
        }	
			 else if (value.includes("Gemas y símbolos")) {
           return "<p>" + "RENAISSANCE" + "</p>"; 
        }	
			
		 else if (value.includes("steri")) {
             return "<p>" + "MYSTERIES" + "</p>"; 
        }
			
		 else if (value.includes("stéri")) {
            return "<p>" + "MYSTERIES" + "</p>"; 
        }
			
		 else if (value.includes("stère")) {
             return "<p>" + "RENAACCADEMIAISSANCE" + "</p>"; 
        }
			
		 else if (value.includes("Accademia")) {
        return "<p>" + "UFFIZI" + "</p>"; 
        }
			
		 else if (value.includes("Uffizi")) {
            return "<p>" + "MEDIEVAL" + "</p>"; 
        }
			
		 else if (value.includes("medieval")) {
         return "<p>" + "MEDIEVAL" + "</p>"; 
        }
			
		 else if (value.includes("Medieval")) {
         return "<p>" + "VECCHIO" + "</p>"; 
        }	
			
			 else if (value.includes("Gourmet")) {
    return "<p>" + "FOOD" + "</p>"; 
        }	
			
			 else if (value.includes("Food")) {
         return "<p>" + "FOOD" + "</p>"; 
        }	
			
			 else if (value.includes("gastron")) {
           return "<p>" + "FOOD" + "</p>"; 
        }
			
			 else if (value.includes("Vecchio")) {
           return "<p>" + "VECCHIO" + "</p>"; 
        }	
				 else if (value.includes("Croce")) {
         return "<p>" + "CROCE" + "</p>"; 
        }	
			else {
             return "<p>" + "N/A" + "</p>"; 
        }
    }
	
    function todayDate() {
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, "0");
        var mm = String(today.getMonth() + 1).padStart(2, "0"); //January is 0!
        var yyyy = today.getFullYear();

        today = yyyy + "-" + mm + "-" + dd;
        return today;
    }
	


    var tableAll = new Tabulator("#example-table", {
        pagination: true, //enable pagination
        paginationMode: "local", //enable remote pagination,
        paginationSize: 750,
        ajaxURL: "https://florencestorytellers.com/paginate/", //set url for ajax request
        ajaxConfig: {
            method: "GET",
            mode: "cors", //set request mode to cors
            credentials: "same-origin", //send cookies with the request from the matching origin
            headers: {
                Accept: "application/json", //tell the server we need JSON back
                "X-Requested-With": "XMLHttpRequest", //fix to help some frameworks respond correctly to request
                "Content-type": "application/json; charset=utf-8", //set the character encoding of the request
            },
        },
        height: "611px",
        layout: "fitColumns",
        placeholder: "No Data Set",
	addRowPos:"top",
		   rowSelectionChanged:function(data, rows){
        //update selected row counter on selection change
    	$("#select-stats span").text(data.length);
    },
		 selectable:true, 
        columns: [
            {
                title: "Status",
                field: "status",
                width: 160,
                editor: "select",
                editorParams: {
                    values: { CANCELED: "CANCELED", MODIFIED: "Modified", NEW: "New" },
                },
                headerFilter: true,
                headerFilterParams: {
                    values: {
                        CANCELED: "CANCELED",
                        MODIFIED: "Modified",
                        NEW: "New",
                        "": "",
                    },
                },
                formatter: statusBackground,
            },

            {
                title: "BookingID",
                field: "bookingID",
                width: 160,
                editor: true,
                headerFilter: "input",
            },
            {
                title: "BookingID2",
                field: "bookingID2",
                width: 160,
                editor: true,
                headerFilter: "input",
            },

            {
                title: "Sender",
                field: "sender",
                width: 160,
                editor: true,
                headerFilter: "input",
            },
            {
                title: "Sender2",
                field: "sender2",
                width: 160,
                editor: true,
                headerFilter: "input",
            },
            {
                title: "Title",
                field: "title",
                width: 160,
                editor: true,
                headerFilter: "input",
            },
            {
                title: "Language",
                field: "language",
                width: 160,
                editor: true,
                headerFilter: "input",
            },
            {
                title: "Date",
                field: "date",
                width: 160,
                editor: true,
                headerFilter: "input",
            },
            {
                title: "Time",
                field: "time",
                width: 160,
                editor: true,
                headerFilter: "input",
            },
            {
                title: "Name",
                field: "name",
                width: 160,
                editor: true,
                headerFilter: "input",
            },
            {
                title: "Surname",
                field: "surname",
                width: 160,
                editor: true,
                headerFilter: "input",
            },
			      {
                title: "Email",
                field: "email",
                width: 160,
                editor: true,
                headerFilter: "input",
            },
            {
                title: "Phone",
                field: "phone",
                width: 160,
                editor: true,
                headerFilter: "input",
            },
            { title: "Adults", field: "adults", width: 160, editor: true },
            { title: "Children", field: "children", width: 160, editor: true },
            { title: "Toddlers", field: "toddlers", width: 160, editor: true },
      
            { title: "Price", field: "price", width: 160, editor: true },
            { title: "Price2", field: "price2", width: 160, editor: true },
            { title: "Shortname", field: "title", width: 160, editor: true, formatter:shortName},
			{formatter:"buttonCross", width:40, align:"center", cellClick:function(e, cell){
    			cell.getRow().delete();
				}},
			{formatter:"buttonTick", width:40, align:"center", },
        ],
    });

    var todayTable = new Tabulator("#today-table", {
        pagination: true, //enable pagination
        paginationMode: "local", //enable remote pagination,
        paginationSize: 750,
        ajaxURL: "https://florencestorytellers.com/paginate/", //set url for ajax request
        ajaxConfig: {
            method: "GET",
            mode: "cors", //set request mode to cors
            credentials: "same-origin", //send cookies with the request from the matching origin
            headers: {
                Accept: "application/json", //tell the server we need JSON back
                "X-Requested-With": "XMLHttpRequest", //fix to help some frameworks respond correctly to request
                "Content-type": "application/json; charset=utf-8", //set the character encoding of the request
            },
        },
        height: "611px",
        layout: "fitColumns",
        placeholder: "No Data Set",
        
           initialFilter:[
            {field:"date", type:"=", value:todayDate()}
        ],
        
        groupBy:"title",
		addRowPos:"top",
      columns: [
            {
                title: "Status",
                field: "status",
                width: 160,
                editor: "select",
                editorParams: {
                    values: { CANCELED: "CANCELED", MODIFIED: "Modified", NEW: "New" },
                },
                headerFilter: true,
                headerFilterParams: {
                    values: {
                        CANCELED: "CANCELED",
                        MODIFIED: "Modified",
                        NEW: "New",
                        "": "",
                    },
                },
                formatter: statusBackground,
            },

            {
                title: "BookingID",
                field: "bookingID",
                width: 160,
                editor: true,
                headerFilter: "input",
            },
            {
                title: "BookingID2",
                field: "bookingID2",
                width: 160,
                editor: true,
                headerFilter: "input",
            },
            {
                title: "Sender",
                field: "sender",
                width: 160,
                editor: true,
                headerFilter: "input",
            },
            {
                title: "Sender2",
                field: "sender2",
                width: 160,
                editor: true,
                headerFilter: "input",
            },
            {
                title: "Title",
                field: "title",
                width: 160,
                editor: true,
                headerFilter: "input",
            },
            {
                title: "Language",
                field: "language",
                width: 160,
                editor: true,
                headerFilter: "input",
            },
            {
                title: "Date",
                field: "date",
                width: 160,
                editor: true,
                headerFilter: "input",
            },
            {
                title: "Time",
                field: "time",
                width: 160,
                editor: true,
                headerFilter: "input",
            },
            {
                title: "Name",
                field: "name",
                width: 160,
                editor: true,
                headerFilter: "input",
            },
            {
                title: "Surname",
                field: "surname",
                width: 160,
                editor: true,
                headerFilter: "input",
            },
			      {
                title: "Email",
                field: "email",
                width: 160,
                editor: true,
                headerFilter: "input",
            },
            {
                title: "Phone",
                field: "phone",
                width: 160,
                editor: true,
                headerFilter: "input",
            },
            { title: "Adults", field: "adults", width: 160, editor: true },
            { title: "Children", field: "children", width: 160, editor: true },
            { title: "Toddlers", field: "toddlers", width: 160, editor: true },
      
            { title: "Price", field: "price", width: 160, editor: true },
            { title: "Price2", field: "price2", width: 160, editor: true },
            { title: "Shortname", field: "title", width: 160, editor: true,  formatter:shortName},
        ],
    });
$("#add-row").click(function(){
    tableAll.addRow({});
});
  //$( document ).ready(function() {
  // table.setSort([
  //    {column:"date", dir:"desc"}, //sort by this first
  //  {column:"time", dir:"asc"}, //then sort by this second
  //{column:"language", dir:"asc"}, //then sort by this second
  //{column:"sender", dir:"asc"}, //then sort by this second
  //{column:"sender2", dir:"asc"}, //then sort by this second
  //{column:"name", dir:"asc"}, //then sort by this second
  // {column:"surname", dir:"asc"}, //then sort by this second

  //   ]);});

  //initialize table
  // var fieldEl = document.getElementById("filter-field");
  // var typeEl = document.getElementById("filter-type");
  // var valueEl = document.getElementById("filter-value");
  // function updateFilter(){
  //     var filterVal = fieldEl.options[fieldEl.selectedIndex].value;
  //     var typeVal = typeEl.options[typeEl.selectedIndex].value;
  //
  //     var filter = filterVal == "function" ? customFilter : filterVal;
  //
  //     if(filterVal == "function" ){
  //         typeEl.disabled = true;
  //         valueEl.disabled = true;
  //     }else{
  //         typeEl.disabled = false;
  //         valueEl.disabled = false;
  //     }
  //
  //     if(filterVal){
  //         table.setFilter(filter,typeVal, valueEl.value);
  //     }
  // }
  //
  // //Update filters on value change
  // document.getElementById("filter-field").addEventListener("change", updateFilter);
  // document.getElementById("filter-type").addEventListener("change", updateFilter);
  // document.getElementById("filter-value").addEventListener("keyup", updateFilter);
  //
  // //Clear filters on "Clear Filters" button click
  // document.getElementById("filter-clear").addEventListener("click", function(){
  //     fieldEl.value = "";
  //     typeEl.value = "=";
  //     valueEl.value = "";
  //
  //     table.clearFilter();
  // });
</script>
