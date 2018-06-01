<?php while (have_posts()) : the_post(); ?>
    <h1 style="margin-bottom: 0px;"><?php the_title(); ?></h1>
<?php endwhile; ?>
<hr style="margin: 2px;" /><br />
<form method="POST" action="">
<div id="responsiveTabsDemo">
    <ul class="rtabs">
        <li><a href="#view_Paypal">Paypal</a></li>
        <li><a href="#view_Wire_transfer">Wire Transfer</a></li>
        <li><a href="#view_Cheque">Cheque</a></li>
        <li><a href="#view_Cash">Cash</a></li>
    </ul>
    <div id="view_Paypal">
        <h2>Paypal</h2>
        <hr style="margin: 2px;" /><br />
        <label for="cash_details">Paypal Email:</label>
        <input id="paypal_email" type="email" value="" name="paypal_email">
    </div>
    <div id="view_Wire_transfer">
        <h2>Wire Transfer</h2>
        <hr style="margin: 2px;" /><br />
        <label for="wire_transfer">Wire Transfer Details</label>
        <textarea id="wire_transfer" name="wire_transfer"></textarea>
    </div>
    <div id="view_Cheque">
        <h2>Cheque</h2>
        <hr style="margin: 2px;" /><br />
        <label for="cheque_details">Mailing Address & Cheque Details</label>
        <textarea id="cheque_details" name="cheque_details"></textarea>
    </div>
    <div id="view_Cash">
        <h2>Cash</h2>
        <hr style="margin: 2px;" /><br />
        <label for="cash_details">Customer Message (optional)</label>
        <textarea id="cash_details" name="cash_details"></textarea>
    </div>
</div>
</form>