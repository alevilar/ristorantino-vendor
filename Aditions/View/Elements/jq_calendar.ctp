



<script id="calendar-header-month" type="text/x-jquery-tmpl">
  <th class="month" data-bind="attr: {colspan: cant}">
     <span data-bind="text: name"></span>
  </th>

</script>


<script id="calendar-header-day" type="text/x-jquery-tmpl">
  <th class="day"  data-bind="attr: {'data-day': $item.data.format('YYYY-MM-DD')}">
      <div>
        <span data-bind="text: format('D')"></span><br />
        <span data-bind="text: format('ddd')"></span>
      </div>
  </th>
</script>


<script id="calendar-mozo-mesas-day-grid" type="text/x-jquery-tmpl">
   <td class="mozo-col day"  data-bind="attr: {'data-day': $item.data.format('YYYY-MM-DD')}"></td>
</script>


<!-- listado de mesas para la grilla calendario-->
<script id="calendar-mozo-mesas-data-day-grid" type="text/x-jquery-tmpl">

       {{if this.data.diasEstadia == 0}}
            <td class="mozo-col libre" data-bind="attr: {'data-day': dayName}">
            	<div></div>
            </td>
        {{else}}
           <td class="mozo-col ocupada" 
               data-bind="attr:{colspan:diasEstadiaRecortado, 'data-checkin': checkin, 'data-checkout': checkout, 'class': grillaExtraClass}">
              <div class="mark">
                 <a  data-bind="click: seleccionar, attr: {accesskey: numero, id: 'mesa-id-'+id(), 'class': estado().icon}" 
                    href="#mesa-view" >                    
                    <span class="mesa-cliente" data-bind="text: clienteNameData()"></span>
                </a>
              </div>
          </td>
        {{/if}}

</script>



<script id="calendar-mozo-row" type="text/x-jquery-tmpl">
  <div  class="mozo mozo-row" data-mozo-id="${id}">
      <div class="mozos-list-vertical col-header">

          <div class="vertical listado-mozos-para-mesas">
              <span data-mozo-id="${id}">${numero}</span>
          </div>              

      </div>

      <div class="content mesas-list">
          <table class="mozo-days">
              <tbody>
                  <tr data-bind='template: { name: "calendar-mozo-mesas-day-grid", foreach: Risto.Adition.adicionar.calendarGrid.days }'></tr>
              </tbody>
         </table>

         <table class="mozo-mesas">
              <tbody>
                  <tr data-bind='template: { name: "calendar-mozo-mesas-data-day-grid", foreach: mesasFromDataRangeByRange() }'></tr>
              </tbody>
         </table>

      </div>
  </div>

</script>                