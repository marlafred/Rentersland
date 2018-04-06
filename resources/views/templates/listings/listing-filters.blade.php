<div class="search-filter">
    <form id="searchForm">
        {{ csrf_field() }}
        <div class="col-sm-3">
                <label>Price Range:</label>
                <span class="price-up">upto $<span class="price-range"></span></span>
                <input type="range" id="range" name="price" value="80">
        </div>
        <div class="col-sm-3">
                <label><i class="fa fa-building" aria-hidden="true"></i> Property Type:</label>
                <select class="form-control" name="property_type" id="property_type">
                    <option value="">Property Type</option>
                    <option value="Condo" label="Condo">Condo</option>
                    <option value="Houseboat" label="Houseboat">Houseboat</option>
                    <option value="Lot / Land" label="Lot / Land">Lot / Land</option>
                    <option value="Single Family Home" label="Single Family Home">Single Family Home</option>
                    <option value="Floorplan" label="Floorplan">Floorplan</option>
                    <option value="Room" label="Room">Room</option>
                    <option value="Townhouse" label="Townhouse">Townhouse</option>
                    <option value="Co-op" label="Co-op">Co-op</option>
                    <option value="Apartment" label="Apartment">Apartment</option>
                    <option value="Loft" label="Loft">Loft</option>
                    <option value="Mobile Manufactured" label="Mobile Manufactured">Mobile Manufactured</option>
                    <option value="Farm / Ranch" label="Farm / Ranch">Farm / Ranch</option>
                    <option value="Multifamily" label="Multifamily">Multifamily</option>
                </select>
        </div>
        <div class="col-sm-3">
                <label><i class="fa fa-bed" aria-hidden="true"></i> Beds:</label>
                <select class="form-control" name="bedrooms" id="bedrooms">
                    <option value="">Beds</option>
                    <option value="1">1+</option>
                    <option value="2">2+</option>
                    <option value="3">3+</option>
                    <option value="4">4+</option>
                    <option value="5">5+</option>
                    <option value="6">6+</option>
                    <option value="7">7+</option>
                    <option value="8">8+</option>
                    <option value="9">9+</option>
                    <option value="10">10+</option>
                </select>
        </div>
        <div class="col-sm-3">
                <label><i class="fa fa-bath" aria-hidden="true"></i> Bath:</label>
                <select class="form-control" name="bathrooms" id="bathrooms">
                    <option value="">Bath</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>
        </div>
    </form>
</div>