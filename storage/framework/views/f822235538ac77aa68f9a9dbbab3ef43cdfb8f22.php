<section id="newsletter">
    <div class="container">
        <div class="row">
            <h1 class="section-heading">newsletter</h1>
            <h3 class="subheading">subscribe for newsletter</h3>
            <form id='newsletterForm' class="col-sm-6 col-sm-push-3" onsubmit="return false;">
                <?php echo e(csrf_field()); ?>

                    <div class="col-sm-8">
                        <input type="email" required="" class="form-control bordered" name="email" placeholder="Type your email address" />
                    </div>
                    <div class="col-sm-4">
                            <input type="submit" class="btn btn-white" name="submit" value="subscribe" />
                    </div>
                <div class="col-sm-8 form-group text-center">
                <br>
                <div class="news-response"></div>
                </div>
            </form>
        </div>
    </div>
</section>