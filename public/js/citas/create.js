
let $doctor,$date,$horas;
let iRadio;
const alertaHoras=`<div class="alert alert-danger" role="alert">
<strong>Lo sentimos!</strong> No se encontraron horas disponibles para el médico en el día seleccionado.
</div>`;

$(function () {
    $especialidad = $('#especialidad');
    $doctor=$('#medico');
    $date=$('#date');
    $horas=$('#horas');
    $especialidad.change(() => {
      const espeId = $especialidad.val();
      const url = `/especialidades/${espeId}/medicos`;
      $.getJSON(url, cargarMedicos);
    });
  

    $doctor.change(cargarHoras);
    $date.change(cargarHoras);


  });    
  
  function cargarMedicos(medicos) {
    let htmlOptions = '';
    medicos.forEach(doctor => {
        htmlOptions += `<option value="${doctor.id}">${doctor.nombres}</option>`;
    });
    $doctor.html(htmlOptions);
    cargarHoras();
  } 

  function cargarMedicos(medicos) {
    let htmlOptions = '';
    medicos.forEach(medico => {
      htmlOptions += `<option value="${medico.id}">${medico.apellidos}</option>`;
    });
    $doctor.html(htmlOptions);
    cargarHoras();
  }

  $.fn.datepicker.defaults.format = "yyyy-mm-dd"; 

  $('.datepicker').datepicker({startDate:0});

  
  
  function cargarHoras(){
    const selectFecha= $date.val();
    const medicoId=$doctor.val();
    const url = `/horarios/horas?fecha=${selectFecha}&medico_id=${medicoId}`;
    $.getJSON(url, mostrarHoras);
  }


  function mostrarHoras(data){
    console.log(data);
    if(!data.mñn && !data.tarde){
        $horas.html(alertaHoras);
        return;
    }

    let htmlHoras = '';
    iRadio = 0;
  

    if(data.mñn){
      const intervalosMñn=data.mñn;
      intervalosMñn.forEach(intervalo=>{
        htmlHoras += mostrarRadioIntervalHtml(intervalo);
      });
    }

    if(data.tarde){
      const intervalosTarde=data.tarde;
      intervalosTarde.forEach(intervalo=>{
      	htmlHoras += mostrarRadioIntervalHtml(intervalo);
      });
    }

    $horas.html(htmlHoras);
  }

  

  function mostrarRadioIntervalHtml(interval) {
    const text = `${interval.inicio} - ${interval.fin}`;
  
    return `<div class="custom-control custom-radio mb-2">
    <input name="hora_cita" value="${interval.inicio}" class="custom-control-input" id="interval${iRadio}" type="radio" required>
    <label class="custom-control-label" for="interval${iRadio++}">${text}</label>
  </div>`;
  }