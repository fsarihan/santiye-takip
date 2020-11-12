require('./bootstrap');

$('#kt_datatable_search_status').select2();
$('#kt_datatable_search_type').select2();

var KTDatatablesBasicBasic = function () {

	var initTable1 = function () {
		var table = $('#maaslar_donemlik_liste');
		table.DataTable({});
	};
};

var KTDatatablesAdvancedColumnRendering = function () {

	var init = function () {
		var table = $('#kt_datatable');


		// begin first table
		table.DataTable({
			data: dataSet,
			dom: 'BHfrtip',
			buttons: [
				{
					extend: 'pdfHtml5',
					text: 'Save current page',
					exportOptions: {
						modifier: {
							page: 'current'
						},
						columns: function (idx, data, node) {
							if (node.innerHTML == "AKSİYON")
								return false;
							return true;
						}
					}
				}
			],
			columns: [
				{title: "AÇIKLAMA"},
				{title: "KALAN TUTAR"},
				{title: "ÖDEME YÖNTEMİ"},
				{title: "DURUM"},
				{title: "DÜZENLENME TARİHİ"},
				{title: "AKSİYON"}
			],
			order: [[4, "desc"]],
			responsive: true,
			paging: true,
			columnDefs: [
				{
					targets: 0,
					orderable: false,
					render: function (data, type, full, meta) {
						var number = 9;
						var output;
						output = `<div class="ml-3">
                                        <span class="text-dark-75 font-weight-bold line-height-sm d-block pb-2">` + full[0] + `</span>
                                        <span class="text-muted text-hover-primary">` + full[1] + `</span>
                                    </div>`;

						return output;
					},
				},
				{
					targets: 1,
					render: function (data, type, full, meta) {
						return `<div class="ml-3">
									<span class="text-dark-75 font-weight-bolder d-block font-size-lg">` + (parseInt(full[2]) - parseInt(full[3])) + ` ₺</span>
									<span class="text-muted font-weight-bold d-block font-size-sm">Toplam: ` + full[2] + ` ₺</span>
								</div>`;
					},
				},

				{
					targets: -1,
					orderable: false,
					render: function (data, type, full, meta) {
						return '\
							<div class="dropdown dropdown-inline">\
								<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">\
	                                <i class="la la-cog"></i>\
	                            </a>\
							  	<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">\
									<ul class="nav nav-hoverable flex-column">\
							    		<li class="nav-item"><a class="nav-link" href="#"><i class="nav-icon la la-edit"></i><span class="nav-text">Edit Details</span></a></li>\
							    		<li class="nav-item"><a class="nav-link" href="#"><i class="nav-icon la la-leaf"></i><span class="nav-text">Update Status</span></a></li>\
							    		<li class="nav-item"><a class="nav-link" href="#"><i class="nav-icon la la-print"></i><span class="nav-text">Print</span></a></li>\
									</ul>\
							  	</div>\
							</div>\
							<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Edit details">\
								<i class="la la-edit"></i>\
							</a>\
							<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete">\
								<i class="la la-trash"></i>\
							</a>\
						';
					},
				},
				{
					targets: 2,
					render: function (data, type, full, meta) {
						var status = {
							1: {'class': ' label-light-primary'},
							2: {'class': ' label-light-success'},
							3: {'class': ' label-light-warning'},
							4: {'class': ' label-light-info'},
						};
						if (typeof status[full[8]] === 'undefined') {
							return data;
						}
						return '<span class="label label-lg font-weight-bold' + status[full[8]].class + ' label-inline">' + full[7] + '</span>';
					},
				},
				{
					targets: 3,
					render: function (data, type, full, meta) {
						var status = {
							1: {'state': 'primary'},
							2: {'state': 'success'},
							3: {'state': 'warning'},
							4: {'state': 'danger'},
							5: {'state': 'info'},
						};
						if (typeof status[full[10]] === 'undefined') {
							return full[9];
						}
						if (full[10] === 2) {
							var returnText = '<span class="label label-' + status[full[10]].state + ' label-dot mr-2"></span>' +
								'<span class="font-weight-bold text-' + status[full[10]].state + '">' + full[9] + '</span><div class="ml-3"><span class="text-muted">Ödendiği Tarih: ' + full[11] + '</span>';
						}
						else {
							var returnText = '<span class="label label-' + status[full[10]].state + ' label-dot mr-2"></span>' +
								'<span class="font-weight-bold text-' + status[full[10]].state + '">' + full[9] + '</span><div class="ml-3"><span class="text-muted">Ödeneceği Tarih: ' + full[4] + '</span>';
						}
						return returnText;
					},
				},
				{
					targets: 4,
					render: function (data, type, full, meta) {
						return '<span class="text-dark-75 font-weight-bold line-height-sm d-block pb-2">' + full[4] + '</span><span class="text-muted">Fatura Tarihi: ' + full[12] + '</span>';
					},
				},
			],
		});

		$('#kt_datatable_search_status').on('change', function () {
			datatable.search($(this).val().toLowerCase(), 'Status');
		});

		$('#kt_datatable_search_type').on('change', function () {
			datatable.search($(this).val().toLowerCase(), 'Type');
		});

		$('#kt_datatable_search_status, #kt_datatable_search_type').selectpicker();
	};

	return {

		//main function to initiate the module
		init: function () {
			init();
		}
	};
}();

jQuery(document).ready(function () {
	KTDatatablesAdvancedColumnRendering.init();
});