



<script id="calendar-header-month" type="text/html">
  <th class="month" data-bind="attr: {colspan: cant}">
     <span data-bind="text: name"></span>
  </th>

</script>


<script id="calendar-header-day" type="text/html">
  <th class="day"  data-bind="attr: {'data-day': format('YYYY-MM-DD')}">
      <div>
        <span data-bind="text: format('D')"></span><br />
        <span data-bind="text: format('ddd')"></span>
      </div>
  </th>
</script>


<script id="calendar-mozo-mesas-day-grid" type="text/html">
   <td class="mozo-col day"  data-bind="attr: {'data-day': format('YYYY-MM-DD')}"></td>
</script>



<!-- listado de mesas para la grilla calendario-->
<script id="calendar-mozo-mesas-data-day-grid-libre" type="text/html">
  <td class="mozo-col libre" data-bind="attr: {'data-day': mesa.dayName}">
    <div></div>
  </td>
</script>


<!-- listado de mesas para la grilla calendario-->
<script id="calendar-mozo-mesas-data-day-grid" type="text/html">              
           <td class="mozo-col ocupada" 
               data-bind="attr:{colspan:mesa.diasEstadiaRecortado, 'data-checkin': mesa.checkin, 'data-checkout': mesa.checkout, 'class': mesa.grillaExtraClass}">
              <div class="mark">
                 <a  data-bind="click: mesa.seleccionar, attr: {accesskey: mesa.numero, id: 'mesa-id-'+mesa.id, 'class': mesa.estado().icon}" 
                    href="#mesa-view" >                    
                    <span class="mesa-cliente" data-bind="text: mesa.clienteNameData"></span>
                </a>
              </div>
          </td>
</script>

