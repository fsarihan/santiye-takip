require('./bootstrap');


// custom select2
$('#kt_datatable_search_status').select2();
$('#kt_datatable_search_type').select2();

var KTDatatablesBasicBasic = function () {

	var initTable1 = function () {
		var table = $('#maaslar_donemlik_liste');
		table.DataTable({});
	};
};