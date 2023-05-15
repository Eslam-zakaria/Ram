@extends('admin.layout.base')

@section('content')
        <!-- row -->
   <div class="container-fluid">
        <!-- &lt;!&ndash; Add Order &ndash;&gt;
        <div class="modal fade" id="addOrderModalside">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Menus</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label class="text-black font-w500">Food Name</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="text-black font-w500">Order Date</label>
                                <input type="date" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="text-black font-w500">Food Price</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-secondary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-sm-3">
                <div class="widget-stat card bg-primary">
                    <div class="card-body  p-4">
                        <div class="media">
                                <span class="mr-3">
                                    <i class="las la-book"></i>
                                </span>
                            <div class="media-body text-white">
                                <p class="mb-1">Numbers Of Booking</p>
                                <h3 class="text-white">{{ $countleads ? $countleads : '0'}}</h3>
                                <div class="progress mb-2 bg-secondary">
                                    <div class="progress-bar bg-light" style="width: 0%"></div>
                                </div>
                                <!-- <small>80% Increase in 30 Days</small> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-sm-3">
                <div class="widget-stat card bg-primary">
                    <div class="card-body p-4">
                        <div class="media">
                                <span class="mr-3">
                                    <i class="las la-book"></i>
                                </span>
                            <div class="media-body text-white">
                                <p class="mb-1">Numbers Of Offer Booking</p>
                                <h3 class="text-white">{{ $countleadsoffer ? $countleadsoffer : '0'}}</h3>
                                <div class="progress mb-2 bg-secondary">
                                    <div class="progress-bar bg-light" style="width: 0%"></div>
                                </div>
                                <!-- <small>30% Increase in 30 Days</small> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-sm-3">
                <div class="widget-stat card bg-primary">
                    <div class="card-body  p-4">
                        <div class="media">
                                <span class="mr-3">
                                    <i class="las la-stethoscope"></i>
                                </span>
                            <div class="media-body text-white">
                                <p class="mb-1">Numbers Of Doctors</p>
                                <h3 class="text-white">{{ $countdoctors ? $countdoctors : '0'}}</h3>
                                <div class="progress mb-2 bg-secondary">
                                    <div class="progress-bar bg-light" style="width: 0%"></div>
                                </div>
                                <!-- <small>50% Increase in 30 Days</small> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-sm-3">
                <div class="widget-stat card bg-primary">
                    <div class="card-body  p-4">
                        <div class="media">
                                <span class="mr-3">
                                    <i class="la la-ambulance"></i>
                                </span>
                            <div class="media-body text-white">
                                <p class="mb-1">Numbers Of Specialities</p>
                                <h3 class="text-white">{{ $countspecifi ? $countspecifi : '0'}}</h3>
                                <div class="progress mb-2 bg-secondary">
                                    <div class="progress-bar bg-light" style="width: 0%"></div>
                                </div>
                                <!-- <small>Based on customers reviews</small> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-sm-6">
            </div>
            <div class="col-xl-3 col-lg-6 col-sm-6">
                <div class="widget-stat card">
                    <div class="card-body p-4">
                        <h4 class="card-title">Total leads of ContactUs</h4>
                        <h3>{{ _countOfLeads('CONTACTUS')}}</h3>
                        <div class="progress mb-2">
                            <div class="progress-bar progress-animated bg-warning" style="width: 50%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-sm-6">
                <div class="widget-stat card">
                    <div class="card-body p-4">
                        <h4 class="card-title">Total leads of Subscriptions</h4>
                        <h3>{{ _countOfLeads('SUBSCRIPTION')}}</h3>
                        <div class="progress mb-2">
                        <div class="progress-bar progress-animated bg-red" style="width: 50%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-sm-6">
            </div>

            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header d-sm-flex flex-wrap d-block pb-0 border-0">
                        <div class="mr-auto pr-3">
                            <h4 class="text-black fs-20">Booking Summary</h4>
                            <p class="fs-13 mb-0 text-black">leads from booking form</p>
                        </div>
                        <div class="card-action card-tabs mt-3 mt-sm-0 mt-3 mb-sm-0 mb-3 mt-sm-0">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#Monthly" role="tab" aria-selected="true">
                                        Monthly
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#Weekly" role="tab" aria-selected="false">
                                        Weekly
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#Today" role="tab" aria-selected="false">
                                        Today
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="Monthly">
                                <div class="row align-items-center">
                                    <div class="col-sm-12">
                                        <div id="radialBar" class="orderChart"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4 mb-md-0 mb-3">
                                        <div class="p-3 border rounded">
                                            <h3 class="fs-32 text-black font-w600 mb-1">{{ _bookingMonthlyCount(0) }}</h3>
                                            <span class="fs-18">Pending</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 mb-md-0 mb-3">
                                        <div class="p-3 border rounded">
                                            <h3 class="fs-32 text-success font-w600 mb-1">{{ _bookingMonthlyCount(1) }}</h3>
                                            <span class="fs-18">Confirmed</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="p-3 border rounded">
                                            <h3 class="fs-32 text-red font-w600 mb-1">{{ _bookingMonthlyCount(2) }}</h3>
                                            <span class="fs-18">Canceled</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="Weekly">
                                <div class="row align-items-center">
                                    <div class="col-sm-12">
                                        <div id="radialBar2" class="orderChart"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4 mb-md-0 mb-3">
                                        <div class="p-3 border rounded">
                                            <h3 class="fs-32 text-black font-w600 mb-1">{{ _bookingWeeklyCount(0) }}</h3>
                                            <span class="fs-18">Pending</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 mb-md-0 mb-3">
                                        <div class="p-3 border rounded">
                                            <h3 class="fs-32 text-success font-w600 mb-1">{{ _bookingWeeklyCount(1) }}</h3>
                                            <span class="fs-18">Confirmed</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="p-3 border rounded">
                                            <h3 class="fs-32 text-red font-w600 mb-1">{{ _bookingWeeklyCount(2) }}</h3>
                                            <span class="fs-18">Canceled</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="Today">
                                <div class="row align-items-center">
                                    <div class="col-sm-12">
                                        <div id="radialBar3" class="orderChart"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4 mb-md-0 mb-3">
                                        <div class="p-3 border rounded">
                                            <h3 class="fs-32 text-black font-w600 mb-1">{{ _bookingDayCount(0) }}</h3>
                                            <span class="fs-18">Pending</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 mb-md-0 mb-3">
                                        <div class="p-3 border rounded">
                                            <h3 class="fs-32 text-success font-w600 mb-1">{{ _bookingDayCount(1) }}</h3>
                                            <span class="fs-18">Confirmed</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="p-3 border rounded">
                                            <h3 class="fs-32 text-red font-w600 mb-1">{{ _bookingDayCount(2) }}</h3>
                                            <span class="fs-18">Canceled</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header d-sm-flex flex-wrap d-block pb-0 border-0">
                        <div class="mr-auto pr-3">
                            <h4 class="text-black fs-20">Offer Booking Summary</h4>
                            <p class="fs-13 mb-0 text-black">leads from offer booking form</p>
                        </div>
                        <div class="card-action card-tabs mt-3 mt-sm-0 mt-3 mb-sm-0 mb-3 mt-sm-0">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#Monthly2" role="tab" aria-selected="true">
                                        Monthly
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#Weekly2" role="tab" aria-selected="false">
                                        Weekly
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#Today2" role="tab" aria-selected="false">
                                        Today
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="Monthly2">
                                <div class="row align-items-center">
                                    <div class="col-sm-6">
                                        <div id="radialBar4" class="orderChart"></div>
                                    </div>
                                    <div class="col-sm-6 mb-sm-0 mb-3 text-center">
                                        <h3 class="fs-28 text-black font-w600">SR {{ _offerbookingMonthlyPaid() }}</h3>
                                        <!-- <span class="mb-3 d-block">from $500,000.00</span>
                                        <p class="fs-14">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do </p>
                                        <a href="#" class="btn btn-secondary btn-rounded">More Details</a> -->
                                        <p class="fs-14">Average paid per month </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4 mb-md-0 mb-3">
                                        <div class="p-3 border rounded">
                                            <h3 class="fs-32 text-black font-w600 mb-1">{{ _offerbookingMonthlyCount(0) }}</h3>
                                            <span class="fs-18">Pending</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 mb-md-0 mb-3">
                                        <div class="p-3 border rounded">
                                            <h3 class="fs-32 text-success font-w600 mb-1">{{ _offerbookingMonthlyCount(1) }}</h3>
                                            <span class="fs-18">Confirmed</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="p-3 border rounded">
                                            <h3 class="fs-32 text-red font-w600 mb-1">{{ _offerbookingMonthlyCount(2) }}</h3>
                                            <span class="fs-18">Canceled</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="Weekly2">
                                <div class="row align-items-center">
                                    <div class="col-sm-6">
                                        <div id="radialBar5" class="orderChart"></div>
                                    </div>
                                    <div class="col-sm-6 mb-sm-0 mb-3 text-center">
                                        <h3 class="fs-28 text-black font-w600">SR {{ _offerbookingWeeklyPaid() }}</h3>
                                        <!-- <span class="mb-3 d-block">from $400,000.00</span>
                                        <p class="fs-14">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do </p>
                                        <a href="#" class="btn btn-secondary btn-rounded">More Details</a> -->
                                        <p class="fs-14">Average paid per week </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4 mb-md-0 mb-3">
                                        <div class="p-3 border rounded">
                                            <h3 class="fs-32 text-black font-w600 mb-1">{{ _offerbookingWeeklyCount(0) }}</h3>
                                            <span class="fs-18">Pending</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 mb-md-0 mb-3">
                                        <div class="p-3 border rounded">
                                            <h3 class="fs-32 text-success font-w600 mb-1">{{ _offerbookingWeeklyCount(1) }}</h3>
                                            <span class="fs-18">Confirmed</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="p-3 border rounded">
                                            <h3 class="fs-32 text-red font-w600 mb-1">{{ _offerbookingWeeklyCount(2) }}</h3>
                                            <span class="fs-18">Canceled</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="Today2">
                                <div class="row align-items-center">
                                    <div class="col-sm-6">
                                        <div id="radialBar6" class="orderChart"></div>
                                    </div>
                                    <div class="col-sm-6 mb-sm-0 mb-3 text-center">
                                        <h3 class="fs-28 text-black font-w600">SR {{ _offerbookingDayPaid() }}</h3>
                                        <!-- <span class="mb-3 d-block">from $800,000.00</span>
                                        <p class="fs-14">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do </p>
                                        <a href="#" class="btn btn-secondary btn-rounded">More Details</a> -->
                                        <p class="fs-14">Average paid per day </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4 mb-md-0 mb-3">
                                        <div class="p-3 border rounded">
                                            <h3 class="fs-32 text-black font-w600 mb-1">{{ _offerbookingDayCount(0) }}</h3>
                                            <span class="fs-18">Pending</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 mb-md-0 mb-3">
                                        <div class="p-3 border rounded">
                                            <h3 class="fs-32 text-success font-w600 mb-1">{{ _offerbookingDayCount(1) }}</h3>
                                            <span class="fs-18">Confirmed</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="p-3 border rounded">
                                            <h3 class="fs-32 text-red font-w600 mb-1">{{ _offerbookingDayCount(2) }}</h3>
                                            <span class="fs-18">Canceled</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    @parent
   <script src="/assets/js/dashboard.js"></script>

   <script>
    var radialBar = function(){
		 var options = {
          series: [{{$monthly_equation}}],
          chart: {
          animations: {
              enabled: false
          },
          height: 300,
          type: 'radialBar',
          offsetY: -10
        },
        plotOptions: {
          radialBar: {
            startAngle: -135,
            endAngle: 135,
            dataLabels: {
              name: {
                fontSize: '16px',
                color: undefined,
                offsetY: 120
              },
              value: {
                offsetY: 0,
                fontSize: '34px',
                color: 'black',
                formatter: function (val) {
                  return val + "%";
                }
              }
            }
          }
        },
        fill: {
          type: 'gradient',
		  colors:'{{ _getoptionColor($monthly_equation) }}',
          gradient: {
              shade: 'dark',
              shadeIntensity: 0.15,
              inverseColors: false,
              opacityFrom: 1,
              opacityTo: 1,
              stops: [0, 50, 65, 91]
          },
        },
        stroke: {
		  colors:'{{ _getoptionColor($monthly_equation) }}'
        },
        labels: [''],
        };

        var chart = new ApexCharts(document.querySelector("#radialBar"), options);
        chart.render();
	}
	var radialBar2 = function(){
		 var options = {
          series: [{{$weekly_equation}}],
          chart: {
          animations: {
              enabled: false
          },
          height: 300,
          type: 'radialBar',
          offsetY: -10
        },
        plotOptions: {
          radialBar: {
            startAngle: -135,
            endAngle: 135,
            dataLabels: {
              name: {
                fontSize: '16px',
                color: undefined,
                offsetY: 120
              },
              value: {
                offsetY: 0,
                fontSize: '34px',
                color: 'black',
                formatter: function (val) {
                  return val + "%";
                }
              }
            }
          }
        },
        fill: {
          type: 'gradient',
		  colors:'{{ _getoptionColor($weekly_equation) }}',
          gradient: {
              shade: 'dark',
              shadeIntensity: 0.15,
              inverseColors: false,
              opacityFrom: 1,
              opacityTo: 1,
              stops: [0, 50, 65, 91]
          },
        },
        stroke: {
		  colors:'{{ _getoptionColor($weekly_equation) }}'
        },
        labels: [''],
        };

        var chart = new ApexCharts(document.querySelector("#radialBar2"), options);
        chart.render();
	}
	var radialBar3 = function(){
		 var options = {
          series: [{{$daly_equation}}],
          chart: {
          animations: {
              enabled: false
          },
          height: 300,
          type: 'radialBar',
          offsetY: -10
        },
        plotOptions: {
          radialBar: {
            startAngle: -135,
            endAngle: 135,
            dataLabels: {
              name: {
                fontSize: '16px',
                color: undefined,
                offsetY: 120
              },
              value: {
                offsetY: 0,
                fontSize: '34px',
                color: 'black',
                formatter: function (val) {
                  return val + "%";
                }
              }
            }
          }
        },
        fill: {
          type: 'gradient',
		  colors:'{{ _getoptionColor($daly_equation) }}',
          gradient: {
              shade: 'dark',
              shadeIntensity: 0.15,
              inverseColors: false,
              opacityFrom: 1,
              opacityTo: 1,
              stops: [0, 50, 65, 91]
          },
        },
        stroke: {
		  colors:'{{ _getoptionColor($daly_equation) }}'
        },
        labels: [''],
        };

        var chart = new ApexCharts(document.querySelector("#radialBar3"), options);
        chart.render();
	}
	var radialBar4 = function(){
		var options = {
		 series: [{{$monthly_equation_offer}}],
		 chart: {
		 animations: {
			 enabled: false
		 },
		 height: 300,
		 type: 'radialBar',
		 offsetY: -10
	   },
	   plotOptions: {
		 radialBar: {
		   startAngle: -135,
		   endAngle: 135,
		   dataLabels: {
			 name: {
			   fontSize: '16px',
			   color: undefined,
			   offsetY: 120
			 },
			 value: {
			   offsetY: 0,
			   fontSize: '34px',
			   color: 'black',
			   formatter: function (val) {
				 return val + "%";
			   }
			 }
		   }
		 }
	   },
	   fill: {
		 type: 'gradient',
		 colors:'{{ _getoptionColor($monthly_equation_offer) }}',
		 gradient: {
			 shade: 'dark',
			 shadeIntensity: 0.15,
			 inverseColors: false,
			 opacityFrom: 1,
			 opacityTo: 1,
			 stops: [0, 50, 65, 91]
		 },
	   },
	   stroke: {
		 colors:'{{ _getoptionColor($monthly_equation_offer) }}'
	   },
	   labels: [''],
	   };

	   var chart = new ApexCharts(document.querySelector("#radialBar4"), options);
	   chart.render();
    }
	var radialBar5 = function(){
		var options = {
		 series: [{{$weekly_equation_offer}}],
		 chart: {
		 animations: {
			 enabled: false
		 },
		 height: 300,
		 type: 'radialBar',
		 offsetY: -10
	   },
	   plotOptions: {
		 radialBar: {
		   startAngle: -135,
		   endAngle: 135,
		   dataLabels: {
			 name: {
			   fontSize: '16px',
			   color: undefined,
			   offsetY: 120
			 },
			 value: {
			   offsetY: 0,
			   fontSize: '34px',
			   color: 'black',
			   formatter: function (val) {
				 return val + "%";
			   }
			 }
		   }
		 }
	   },
	   fill: {
		 type: 'gradient',
		 colors:'{{ _getoptionColor($weekly_equation_offer) }}',
		 gradient: {
			 shade: 'dark',
			 shadeIntensity: 0.15,
			 inverseColors: false,
			 opacityFrom: 1,
			 opacityTo: 1,
			 stops: [0, 50, 65, 91]
		 },
	   },
	   stroke: {
		 colors:'{{ _getoptionColor($weekly_equation_offer) }}'
	   },
	   labels: [''],
	   };

	   var chart = new ApexCharts(document.querySelector("#radialBar5"), options);
	   chart.render();
    }
	var radialBar6 = function(){
		var options = {
		 series: [{{$daly_equation_offer}}],
		 chart: {
		 animations: {
			 enabled: false
		 },
		 height: 300,
		 type: 'radialBar',
		 offsetY: -10
	   },
	   plotOptions: {
		 radialBar: {
		   startAngle: -135,
		   endAngle: 135,
		   dataLabels: {
			 name: {
			   fontSize: '16px',
			   color: undefined,
			   offsetY: 120
			 },
			 value: {
			   offsetY: 0,
			   fontSize: '34px',
			   color: 'black',
			   formatter: function (val) {
				 return val + "%";
			   }
			 }
		   }
		 }
	   },
	   fill: {
		 type: 'gradient',
		 colors:'{{ _getoptionColor($daly_equation_offer) }}',
		 gradient: {
			 shade: 'dark',
			 shadeIntensity: 0.15,
			 inverseColors: false,
			 opacityFrom: 1,
			 opacityTo: 1,
			 stops: [0, 50, 65, 91]
		 },
	   },
	   stroke: {
		 colors:'{{ _getoptionColor($daly_equation_offer) }}'
	   },
	   labels: [''],
	   };

	   var chart = new ApexCharts(document.querySelector("#radialBar6"), options);
	   chart.render();
    }
    
   </script>
@endsection
