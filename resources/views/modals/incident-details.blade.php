<!-- Modal -->
<div class="modal fade" id="incidentDetailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="max-width: 300px">
      <div class="modal-header" style="border-bottom: none; font-size: 14px; padding-bottom: 0" >
        <p class="modal-title" id="exampleModalLabel">Incident Details</p>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="background: red">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table">
          <tbody style="font-size: 12px">
            <tr>
              <td>Region</td>
              <td class="region"></td>
            </tr>
            <tr>
              <td>Time</td>
              <td class="time"></td>
            </tr>
            <tr hidden="">
              <td>Number of Death</td>
              <td class="number_of_death"></td>
            </tr>
            <tr hidden="">
              <td>Minimum Estimated Number of Missing</td>
              <td class="minimum_estimated_number_of_missing"></td>
            </tr>
            <tr>
              <td>Total Dead and Missing</td>
              <td class="total_dead_and_missing"></td>
            </tr>
            <tr hidden="">
              <td>Number of Survivors</td>
              <td class="number_of_survivors"></td>
            </tr>
            <tr>
              <td>Cause of Death</td>
              <td class="cause_of_death"></td>
            </tr>
            <tr hidden="">
              <td>Location Description</td>
              <td class="location_description"></td>
            </tr>
          </tbody>
        </table>

      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>