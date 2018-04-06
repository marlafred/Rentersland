
    <h3>Additional Information</h3>
    
    <div class="col-sm-6">
        <label>Will you have pets?</label>
    </div>
    <div class="col-sm-6">
        <?php $myval = ''; ?>
        @if(isset($info->add_pets))
            <?php $myval = $info->add_pets; ?>
        @endif
        <div class="pretty p-image p-plain">
            <input type="radio"  name="add_pets" value="yes" @if($myval=='yes') checked @endif />
            <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">
              <label>Yes</label>
            </div>
        </div>

        <div class="pretty p-image p-plain">
            <input type="radio" name="add_pets" value="no" @if($myval=='no') checked @endif  />
            <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">
              <label>No</label>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    
    <div class="col-sm-6">
        <label>Will you have liquid filled furniture?</label>
    </div>
    <div class="col-sm-6">
        <?php $myval = ''; ?>
        @if(isset($info->add_furniture))
            <?php $myval = $info->add_furniture; ?>
        @endif
        <div class="pretty p-image p-plain">
            <input type="radio"  name="add_furniture" value="yes" @if($myval=='yes') checked @endif />
            <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">
              <label>Yes</label>
            </div>
        </div>

        <div class="pretty p-image p-plain">
            <input type="radio" name="add_furniture" value="no" @if($myval=='no') checked @endif />
            <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">
              <label>No</label>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    
    <div class="col-sm-6">
        <label>Have you ever had bedbugs?</label>
    </div>
    <div class="col-sm-6">
        <?php $myval = ''; ?>
        @if(isset($info->add_bugs))
            <?php $myval = $info->add_bugs; ?>
        @endif
        <div class="pretty p-image p-plain">
            <input type="radio"  name="add_bugs" value="yes" @if($myval=='yes') checked @endif />
            <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">
              <label>Yes</label>
            </div>
        </div>

        <div class="pretty p-image p-plain">
            <input type="radio" name="add_bugs" value="no" @if($myval=='no') checked @endif />
            <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">
              <label>No</label>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    
    <div class="col-sm-6">
        <label>Have you ever been evicted?</label>
    </div>
    <div class="col-sm-6">
        <?php $myval = ''; ?>
        @if(isset($info->add_avicted))
            <?php $myval = $info->add_avicted; ?>
        @endif
        <div class="pretty p-image p-plain">
            <input type="radio"  name="add_avicted" value="yes" @if($myval=='yes') checked @endif />
            <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">
              <label>Yes</label>
            </div>
        </div>

        <div class="pretty p-image p-plain">
            <input type="radio" name="add_avicted" value="no" @if($myval=='no') checked @endif />
            <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">
              <label>No</label>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    
    <div class="col-sm-6">
        <label>Have you ever filed for bankruptcy?</label>
    </div>
    <div class="col-sm-6">
        <?php $myval = ''; ?>
        @if(isset($info->add_bank))
            <?php $myval = $info->add_bank; ?>
        @endif
        <div class="pretty p-image p-plain">
            <input type="radio"  name="add_bank" value="yes" @if($myval=='yes') checked @endif />
            <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">
              <label>Yes</label>
            </div>
        </div>

        <div class="pretty p-image p-plain">
            <input type="radio" name="add_bank" value="no" @if($myval=='no') checked @endif />
            <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">
              <label>No</label>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    
    <div class="col-sm-6">
        <label>Do you smoke?</label>
    </div>
    <div class="col-sm-6">
        <?php $myval = ''; ?>
        @if(isset($info->add_smoke))
            <?php $myval = $info->add_smoke; ?>
        @endif
        <div class="pretty p-image p-plain">
            <input type="radio"  name="add_smoke" value="yes" @if($myval=='yes') checked @endif />
            <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">
              <label>Yes</label>
            </div>
        </div>

        <div class="pretty p-image p-plain">
            <input type="radio" name="add_smoke" value="no" @if($myval=='no') checked @endif />
            <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">
              <label>No</label>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    
    <div class="col-sm-6">
        <label>Have you ever been convicted of selling, distributing or manufacturing illegal drugs?</label>
    </div>
    <div class="col-sm-6">
        <?php $myval = ''; ?>
        @if(isset($info->add_drugs))
            <?php $myval = $info->add_drugs; ?>
        @endif
        <div class="pretty p-image p-plain">
            <input type="radio"  name="add_drugs" value="yes" @if($myval=='yes') checked @endif />
            <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">
              <label>Yes</label>
            </div>
        </div>

        <div class="pretty p-image p-plain">
            <input type="radio" name="add_drugs" value="no" @if($myval=='no') checked @endif />
            <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">
              <label>No</label>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    
    
    <div class="clearfix"></div>
