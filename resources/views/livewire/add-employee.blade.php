<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="addemployee" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form  >
                        <div class="form-group">
                            <input type="text" class="form-control" wire:model='name' name="name" placeholder="Enter name" autofocus>
                            @if($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control email" wire:model='email' name="email" placeholder="Enter email" >
                            @if($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <select name="designation" class="form-control" wire:model='designation'>
                                <option value="" selected hidden class="">Select Designation</option>
                                <option value="Manager" class="">Manager</option>
                                <option value="Retailer" class="">Retailer</option>
                                <option value="Guard" class="">Guard</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" wire:model='password' name="password" placeholder="Enter Password">
                            @if($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" wire:model='cfpassword' name="cfpassword" placeholder="Confirm Password">
                            @if($errors->has('cfpassword'))
                                        <span class="text-danger">{{ $errors->first('cfpassword')}}</span>
                            @endif
                        </div>

                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" wire:click.prevent='save()'>Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
