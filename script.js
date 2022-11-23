

 

//Add Finished Product's Div

function addRow() {
    const div = document.createElement("div");

    div.className = "rowsToAdd";

  div.innerHTML = `<div class="form-group">
  <label class="control-label">Destination From :</label>
  <div class="controls">
    <input
      type="text"
      class="span11"
      id="destination_from"
      name="destination_from[]"
      placeholder="starting point"
      value=""
    />
  </div>
</div>
    <div class="form-group">
    <label class="control-label">Destination To :</label>
    <div class="controls">
      <input
        type="text"
        class="span11"
        id="destination_to"
        name="destination_to[]"
        placeholder="Endpoint"
        value=""
      
      />
    </div>
  </div>

  <div class="form-group">
    <label class="control-label">Enter Fair :</label>
    <div class="controls">
      <input
        type="text"
        class="fair"
        id="fair"
        name="fair"
        placeholder="Finished Quantity"
        value=""
      

      
      />
 
    </div>
  </div>
  <input type="button" class="addButtonTwo" value="+" onclick="addRow()" />
  
</div>
<div id="formTwoContainer">

</div>
   
    <input type="button" class="removeButtonTwo" value="-" onclick="removeRow(this)" />
  `;

    document.querySelector('.formTwoContainer').appendChild(div);
  }

  function removeRow(input) {
    document.querySelector(".formTwoContainer").removeChild(input.parentNode);
  }
  $("#fair").on('input',function(){
    let getValue=$(this).val();
    console.log(getValue);
  });
//




