<!DOCTYPE html>
<!-- http://mfikri.com/en/blog/crud-codeigniter-ajax -->
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>CCAS</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap.css'?>">
</head>
<body>
<div class="container"> <!--responsive fixed width container -->
	  <!-- Control the column width, and how they should appear on different devices -->
    <div class="row">
        <div class="col-12">  <!-- extra small devices - screen width less than 576px, 12 columns -->
            <div class="col-md-12"> <!-- medium devices - screen width equal to or greater than 768px -->
                <h1>Course Coordinator Advise System</h1>
                <div class="d-flex justify-content-center">
                  <br><br><br><br><br><br>
                  <form class="form-inline">
                    <input type="text" name="search_student_id" id="search_student_id" class="form-control" placeholder="Enter Student ID">
                    <button type="submit" id="btn_search" class="btn btn-primary ">Search</button>
                  </form>
                </div>
            </div>
            <div id="studentdata">
            </div>
            <table class="table table-striped" id="mydata">
                <thead>
                    <tr>
                        <th>Unit ID</th>
                        <th>Unit Name</th>
                        <th>Credits</th>
                        <th>Prerequisite</th>
                        <th>Status</th>
                        <th>Grade</th>
                        <th>Period</th>
                        <th>Institution</th>
                        <th>Pickable</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="show_data">
                </tbody>
            </table>
        </div>
    </div>
</div>

		<!-- MODAL ADD -->
            <form>
            <div class="modal fade" id="Modal_Add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<!--  tabindex="-1" disables the tabbing order for elements in the current document -->
							<!-- role="dialog" improves accessibility for people using screen readers, e.g. for text to speech  -->
              <!-- aria-labelledby  stablishes relationships between objects and their label(s),
							     and its value should be one or more element IDs,
									 which refer to elements that have the text needed for labeling.
									 Useful for screen readers
									 https://developer.mozilla.org/en-US/docs/Web/Accessibility/ARIA/ARIA_Techniques/Using_the_aria-labelledby_attribute
							-->
              <div class="modal-dialog modal-lg" role="document">
								<!-- role="document" improves acessibility for people using screen readers -->
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">The student does not exist! Do you want to add a new student?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<!--  closes the modal if you click on it -->
											<!-- aria-label provides the text "Close" for screen readers -->
                      <span aria-hidden="true">&times;</span> <!-- &times; causes x to be displayed -->
                    </button>
                  </div>
                  <div class="modal-body">
                        <div class="form-group row">
													  <!-- 2/12 for label and 10/12 for input field -->
                            <label class="col-md-2 col-form-label">Student ID</label>
                            <div class="col-md-10">
                              <input type="text" name="student_id" id="student_id" class="form-control" placeholder="Student ID">
                            </div>

                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">First Name</label>
                            <div class="col-md-10">
                              <input type="text" name="student_first_name" id="student_first_name" class="form-control" placeholder="First Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Last Name</label>
                            <div class="col-md-10">
                              <input type="text" name="student_last_name" id="student_last_name" class="form-control" placeholder="Last Name">
                            </div>
                        </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="btn_save" class="btn btn-primary">Save</button>
                  </div>
                </div>
              </div>
            </div>
            </form>
        <!--END MODAL ADD-->

    <!-- MODAL EDIT -->
    <form>
            <div class="modal fade" id="Modal_Edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                        <div class="form-group row" style="display: none;">
                            <label class="col-md-2 col-form-label">Student ID</label>
                            <div class="col-md-10">
                              <input type="text" name="student_id_edit" id="student_id_edit" class="form-control" placeholder="Student ID" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Unit Name</label>
                            <div class="col-md-10">
                              <input type="text" name="unit_name_edit" id="unit_name_edit" class="form-control" placeholder="Unit Name" readonly>
                            </div>
                        </div>
                        <div class="form-group row" style="display: none;">
                            <label class="col-md-2 col-form-label">Unit ID</label>
                            <div class="col-md-10">
                              <input type="text" name="unit_id_edit" id="unit_id_edit" class="form-control" placeholder="Unit ID" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Status</label>
                            <div class="col-md-10">
                              <select name="status_edit" id="status_edit" class="form-control">
                                <option value="not enrolled">Not enrolled</option>
                                <option value="enrolled">Enrolled</option>
                                <option value="un enrolled">Un enrolled</option>
                                <option value="passed">Passed</option>
                                <option value="failed">Failed</option>
                                <option value="deferred">Deferred</option>
                              </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Grade</label>
                            <div class="col-md-10">
                              <select name="grade_edit" id="grade_edit" class="form-control">
                                <option value="HD">HD: High Distinction</option>
                                <option value="D">D: Distinction</option>
                                <option value="C">C: Credit</option>
                                <option value="P">P: Pass</option>
                                <option value="N">N: Fail</option>
                              </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Period</label>
                            <div class="col-md-10">
                              <select name="period_edit" id="period_edit" class="form-control">
                                <option value="semester 1- year 2019">Semester 1- Year 2019</option>
                                <option value="semester 2- year 2019">Semester 2- Year 2019</option>
                                <option value="summer- year 2019">Summer- Year 2019</option>
                                <option value="semester 1- year 2020">Semester 1- Year 2020</option>
                                <option value="semester 2- year 2020">Semester 2- Year 2020</option>
                                <option value="summer- year 2020">Summer- Year 2020</option>
                              </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Instituition</label>
                            <div class="col-md-10">
                              <input type="text" name="institution_edit" id="institution_edit" class="form-control" placeholder="Instituition">
                            </div>
                        </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" type="submit" id="btn_update" class="btn btn-primary">Update</button>
                  </div>
                </div>
              </div>
            </div>
            </form>
        <!--END MODAL EDIT-->


<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-3.2.1.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap.js'?>"></script>

<script type="text/javascript">

$(document).ready(function(){

  function predicateBy(prop){
   return function(a,b){
      if( a[prop] > b[prop]){
          return 1;
      }else if( a[prop] < b[prop] ){
          return -1;
      }
      return 0;
   }
  }

  //AJAX call to download all students before the page is loaded on the browser
  $('#btn_search').on('click', loadStudentData);
      //Load student
      function loadStudentData(e){
        if (e.target.id =='btn_search') {
          e.preventDefault();
        }
        let student_id = $('#search_student_id').val();
        $.ajax({
            type  : 'POST',
            url   : '<?php echo site_url('main/search')?>',
            dataType : 'JSON',
            data : {student_id : student_id},
            success : function(data){
              $('#search_student_id').val("");
              //JSON encoded data will be in the form:
              //[
              // {"student_id" : 12345678,"student_first_name" :  "John","student_last_name" : "Doe"    },
              // {"student_id" : "11111111","student_first_name" : "Jane" "29","student_last_name" : "Doe"}
              //];
                if (data.length == 0){
                  $('[name="student_id"]').val(student_id);
                  $('[name="student_first_name"]').val("");
                  $('[name="student_last_name"]').val("");
                  $('#Modal_Add').modal('show');
                }
                
                let studentDetail = `<h4>${data[0].student_first_name} ${data[0].student_last_name}'s program map (SID = ${student_id}):</h4>`;
                $('#studentdata').html(studentDetail);

                let sortedData= data.sort(predicateBy("status")).sort(predicateBy("is_pickable")).reverse();
                let html = '';
                let i;
                for(i=1; i<sortedData.length; i++){
                    switch(sortedData[i].status) {
                      case 'not enrolled':
                      html += '<tr class="bg-primary text-white">';
                      break;
                      case 'enrolled':
                      html += '<tr class="bg-info text-white">';
                      break;
                      case 'passed':
                      html += '<tr class="bg-success text-white">';
                      break;
                      case 'failed':
                      html += '<tr class="bg-danger text-white">';
                      break;
                      case 'un enrolled':
                      html += '<tr class="bg-secondary text-white">';
                      break;
                      case 'deferred':
                      html += '<tr class="bg-dark text-white">';
                      break;
                    }
                    html += '<td>'+sortedData[i].unit_id+'</td>'+
                            '<td>'+sortedData[i].unit_name+'</td>'+
                            '<td>'+sortedData[i].unit_credits+'</td>'+
                            '<td>'+sortedData[i].unit_prerequisite+'</td>'+
                            '<td>'+sortedData[i].status+'</td>'+
                            '<td>'+sortedData[i].grade+'</td>'+
                            '<td>'+sortedData[i].period+'</td>'+
                            '<td>'+sortedData[i].institution+'</td>'+
                            '<td>'+sortedData[i].is_pickable+'</td>';
                    if (sortedData[i].is_pickable == 1) {
                      html += '<td style="text-align:right;">'+
                              '<a href="javascript:void(0);" class="btn btn-light btn-sm item_edit" data-student_id="'
                              +sortedData[i].student_id+'" data-unit_id="'
                              +sortedData[i].unit_id+'" data-unit_name="'
                              +sortedData[i].unit_name+'" data-status="'
                              +sortedData[i].status+'" data-grade="'
                              +sortedData[i].grade+'" data-period="'
                              +sortedData[i].period+'" data-institution="'
                              +sortedData[i].institution+'">Edit</a></td></tr>';
                    } else {
                      html += '<td style="text-align:right;">'+
                              '<a href="javascript:void(0);" class="btn btn-light btn-sm disabled item_edit"><del>Edit</del></a></td></tr>';
                    }

                }
                $('#show_data').html(html);
            }

        });
      }
      //Save student
      $('#btn_save').on('click',function(e){
          let student_id = $('#student_id').val();
          let student_first_name = $('#student_first_name').val();
          let student_last_name        = $('#student_last_name').val();
          $.ajax({
              type : "POST",
              url  : "<?php echo site_url('main/save')?>",
              dataType : "JSON",
              data : {student_id : student_id, student_first_name : student_first_name, student_last_name : student_last_name},
              success: function(data){
                  $('[name="student_id"]').val("");
                  $('[name="student_first_name"]').val("");
                  $('[name="student_last_name"]').val("");
                  $('#Modal_Add').modal('hide');
                  $('#search_student_id').val(student_id);
                  loadStudentData(e);
              }
          });
          return false;
      });

      //get data for update record
      $('#show_data').on('click','.item_edit',function(){
            var student_id = $(this).data('student_id');
            var unit_name = $(this).data('unit_name');
            var unit_id = $(this).data('unit_id');
            var status = $(this).data('status');
            var grade = $(this).data('grade');
            var period = $(this).data('period');
            var institution = $(this).data('institution');
             
            $('#Modal_Edit').modal('show');
            $('[name="student_id_edit"]').val(student_id);
            $('[name="unit_name_edit"]').val(unit_name);
            $('[name="unit_id_edit"]').val(unit_id);
            $('[name="status_edit"]').val(status);
            $('[name="grade_edit"]').val(grade);
            $('[name="period_edit"]').val(period);
            $('[name="institution_edit"]').val(institution);
        });

      // Form Change
      $("#status_edit").change(function(){
        if ($("#status_edit").val() == 'failed') {
          $("#grade_edit").val('N');
          $("#grade_edit").attr('disabled', 'disabled');
          $("#period_edit").removeAttr('disabled', 'disabled');
          $("#institution_edit").removeAttr('disabled', 'disabled');
        }
        if ($("#status_edit").val() == 'not enrolled') {
          $("#grade_edit").val('');
          $("#grade_edit").attr('disabled', 'disabled');
          $("#period_edit").val('');
          $("#period_edit").attr('disabled', 'disabled');
          $("#institution_edit").val('');
          $("#institution_edit").attr('disabled', 'disabled');
        }
        if ($("#status_edit").val() == 'enrolled') {
          $("#grade_edit").val('');
          $("#grade_edit").attr('disabled', 'disabled');
          $("#period_edit").removeAttr('disabled', 'disabled');
          $("#institution_edit").removeAttr('disabled', 'disabled');
        }
        if ($("#status_edit").val() == 'un enrolled') {
          $("#grade_edit").val('');
          $("#grade_edit").attr('disabled', 'disabled');
          $("#period_edit").removeAttr('disabled', 'disabled');
          $("#institution_edit").removeAttr('disabled', 'disabled');
        }
        if ($("#status_edit").val() == 'deferred') {
          $("#grade_edit").val('');
          $("#grade_edit").attr('disabled', 'disabled');
          $("#period_edit").removeAttr('disabled', 'disabled');
          $("#institution_edit").removeAttr('disabled', 'disabled');
        }
        if ($("#status_edit").val() == 'passed') {
          $("#grade_edit").val('');
          $("#grade_edit").removeAttr('disabled', 'disabled');
          $("#period_edit").removeAttr('disabled', 'disabled');
          $("#institution_edit").removeAttr('disabled', 'disabled');
        }
      });
      $("#grade_edit").change(function(){
        $('#grade_edit').removeClass('alert alert-danger');
        if ($("#grade_edit").val() == 'N') {
          $("#status_edit").val('failed');
        } else {
          $("#status_edit").val('passed');
        }
      });
      $("#period_edit").change(function(){
        $('#period_edit').removeClass('alert alert-danger');
      });
      $("#institution_edit").change(function(){
        $('#institution_edit').removeClass('alert alert-danger');
      });


      //update record to database
      $('#btn_update').on('click',function(e){
            var student_id = $('#student_id_edit').val();
            var unit_id = $('#unit_id_edit').val();
            var status = $('#status_edit').val();
            var grade = $('#grade_edit').val();
            var period = $('#period_edit').val();
            var institution = $('#institution_edit').val();

            // Form Validation
            if (status =='not enrolled') {
              $("#grade_edit").val('');
              grade = $('#grade_edit').val();
              $("#grade_edit").attr('disabled', 'disabled');
              $("#period_edit").val('');
              period = $('#period_edit').val();
              $("#period_edit").attr('disabled', 'disabled');
              $("#institution_edit").val('');
              institution = $('#institution_edit').val();
              $("#institution_edit").attr('disabled', 'disabled');
            }
            if (grade == null && status =='passed') {
              $('#grade_edit').addClass('alert alert-danger');
              return false;
            }
            if (period == null && status !='not enrolled') {
              $('#period_edit').addClass('alert alert-danger');
              return false;
            }
            if (institution == '' && status !='not enrolled') {
              $('#institution_edit').addClass('alert alert-danger');
              return false;
            }
            
            $.ajax({
                type : "POST",
                url  : "<?php echo site_url('main/update')?>",
                dataType : "JSON",
                data : {student_id:student_id, unit_id:unit_id, status:status , grade:grade, period:period, institution:institution},
                
                success: function(data){
                    $('[name="student_id_edit"]').val("");
                    $('[name="unit_name_edit"]').val("");
                    $('[name="unit_id_edit"]').val("");
                    $('[name="status_edit"]').val("");
                    $('[name="grade_edit"]').val("");
                    $('[name="period_edit"]').val("");
                    $('[name="institution_edit"]').val("");
                    $('#grade_edit').removeClass('alert alert-danger');
                    $('#period_edit').removeClass('alert alert-danger');
                    $('#institution_edit').removeClass('alert alert-danger');
                    $("#grade_edit").removeAttr('disabled', 'disabled');
                    $("#period_edit").removeAttr('disabled', 'disabled');
                    $("#institution_edit").removeAttr('disabled', 'disabled');
                    $('#Modal_Edit').modal('hide');
                    $('#search_student_id').val(student_id);
                    loadStudentData(e);
                }
            });
            return false;
        });

});

</script>
</body>
</html>

