<?php $home = home_url( '/' ); ?>
<form role="search" method="get" class="search-form" action="<?php echo $home; ?>">
    <div>
        <label class="search-label" for="s">Search for:</label>
        <button type="button" class="sbutton search-button"><i class="fas fa-search" aria-hidden="true"></i>Search</button>
        <input type="text" value="" name="s" class="search-input" placeholder="Search our store" />
        <input type="submit" class="search-submit" value="search"/>
    </div>
</form>