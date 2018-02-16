<!-- Modal -->
<div id="myModal" class="modal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="prod_name">Product name</h4>
      </div>
      
      <div class="modal-body">
          <div class="row">
            
            <div class="col-md-6">
              <div class="form-group">
                <label>Product name</label>
                <input type="text" class="form-control" />
              </div>

              <div class="form-group">
                <label>Product Sale price</label>
                <input type="text" class="form-control" id="product_price"/>
              </div>

              <div class="form-group">
                <label>sale start</label>
                <input type="date" class="form-control"/>
              </div>

              <div class="form-group">
                  <label>sale end</label>
                  <input type="date" class="form-control"/>
                </div>
            </div>

            <div class="col-md-6" style="margin-top:1%;">
              <a data-haggle="bargain" style="cursor:pointer;color:black;" data->
                <div class="text-center" style="border:2px solid #333;padding:50px;">
                <h3>BARGAIN</h3>
              </div></a>
              <a data-haggle="auction" style="cursor:pointer;color:black;" >
                <div class="text-center" style="border:2px solid #333;padding:50px;">
                <h3>Auction</h3>
              </div></a>
            </div>
          </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-default">Save Changes</button>
      </div>
    </div>

  </div>
</div>

<!-- 2nd modal -->

<div id="groupModal" class="modal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="color:white;background:#AB2A2F;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Create Product group</h4>
      </div>
      <div class="modal-body">
        
        <div class="form-group">
          <label>Group name</label>
          <input type="text" class="form-control" id="g_name"/>
        </div>
        
        <div class="row">

          <div class="col-md-6">
            <div class="form-group">
              <label>Product list</label>
              <input type="text" class="form-control" placeholder="search name of the product" />
            </div>

            <div class="prod-list-container">
              <ul class="prod-list group-list">
                  @forelse($product as $prod)
                  
                      <li data-clone="{{ $prod->id }}" >
                        <img src="{{ asset('storage').'/'.$prod->product_photo }}" style="width:80px;" /> 
                        <span>{{ $prod->product_name }}</span>
                      </li>
                      @empty
                      
                  @endforelse
              </ul>
            </div>
            
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Selected Product</label>
            </div>

            <div class="prod-list-container pro-list">
              
            </div>
          </div>

        </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="group">Save</button>
      </div>
    </div>

  </div>
</div>