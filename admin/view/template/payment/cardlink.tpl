<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-pp-std-uk" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-pp-std-uk" class="form-horizontal">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab-general">
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="cardlink_mid"><?php echo $entry_mid; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="cardlink_mid" value="<?php echo $cardlink_mid; ?>" placeholder="<?php echo $cardlink_mid; ?>" id="cardlink_mid" class="form-control"/>
                  <?php if ($warning_mid) { ?>
                  <div class="text-danger"><?php echo $warning_mid; ?></div>
                  <?php } ?>
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="cardlink_digest"><?php echo $digest; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="cardlink_digest" value="<?php echo $cardlink_digest; ?>" placeholder="<?php echo $cardlink_digest; ?>" id="cardlink_digest" class="form-control"/>
                  <?php if ($warning_digest) { ?>
                  <div class="text-danger"><?php echo $warning_digest; ?></div>
                  <?php } ?>
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="sanbox"><span data-toggle="tooltip" title="<?php echo $help_sanbox; ?>"><?php echo $sandbox; ?></span></label>
                <div class="col-sm-10">
                  <select name="cardlink_sandbox" id="cardlink_sandbox" class="form-control">
                    <?php if ($cardlink_sandbox) { ?>
                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                    <option value="0"><?php echo $text_disabled; ?></option>
                    <?php } else { ?>
                    <option value="1"><?php echo $text_enabled; ?></option>
                    <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="cardlink_bank"><?php echo $bank; ?></label>
                <div class="col-sm-10">
                  <select name="cardlink_bank" id="cardlink_bank" class="form-control">
                    <?php if ($cardlink_bank) { ?>
                    <option value="1" selected="selected"><?php echo $alphabank; ?></option>
                    <option value="0"><?php echo $eurobank; ?></option>
                    <?php } else { ?>
                    <option value="1"><?php echo $alphabank; ?></option>
                    <option value="0" selected="selected"><?php echo $eurobank; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="cardlink_installments"><span data-toggle="tooltip" title="<?php echo $installments_number_tip; ?>"><?php echo $installments; ?></span></label>
                <div class="col-sm-10">
                  <input type="text" name="cardlink_installments" value="<?php echo $cardlink_installments; ?>" placeholder="<?php echo $cardlink_installments; ?>" id="cardlink_installments" class="form-control"/>
                  <?php if ($warning_installments) { ?>
                  <div class="text-danger"><?php echo $warning_installments; ?></div>
                  <?php } ?>
                  <?php if ($warning_empty_installments) { ?>
                  <div class="text-danger"><?php echo $warning_empty_installments; ?></div>
                  <?php } ?>
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="cardlink_minimum_installments_cost"><span data-toggle="tooltip" title="<?php echo $installments_tip; ?>"><?php echo $minimum_installments_cost; ?></span></label>
                <div class="col-sm-10">
                  <input type="text" name="cardlink_minimum_installments_cost" value="<?php echo $cardlink_minimum_installments_cost; ?>" placeholder="<?php echo $cardlink_minimum_installments_cost; ?>" id="cardlink_minimum_installments_cost" class="form-control"/>
                  <?php if ($warning_minimum_installments_cost) { ?>
                  <div class="text-danger"><?php echo $warning_minimum_installments_cost; ?></div>
                  <?php } ?>
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="cardlink_confirmUrl"><?php echo $entry_confirmUrl; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="cardlink_confirmUrl" value="<?php echo $cardlink_confirmUrl; ?>" placeholder="<?php echo $cardlink_confirmUrl; ?>" id="cardlink_confirmUrl" class="form-control"/>
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="cardlink_cancelUrl"><?php echo $entry_cancelUrl; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="cardlink_cancelUrl" value="<?php echo $cardlink_cancelUrl; ?>" placeholder="<?php echo $cardlink_cancelUrl; ?>" id="cardlink_cancelUrl" class="form-control"/>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-geo-zone"><?php echo $entry_geo_zone; ?></label>
                <div class="col-sm-10">
                  <select name="cardlink_geo_zone_id" id="input-geo-zone" class="form-control">
                    <option value="0"><?php echo $text_all_zones; ?></option>
                    <?php foreach ($geo_zones as $geo_zone) { ?>
                    <?php if ($geo_zone['geo_zone_id'] == $cardlink_geo_zone_id) { ?>
                    <option value="<?php echo $geo_zone['geo_zone_id']; ?>" selected="selected"><?php echo $geo_zone['name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
                <div class="col-sm-10">
                  <select name="cardlink_status" id="input-status" class="form-control">
                    <?php if ($cardlink_status) { ?>
                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                    <option value="0"><?php echo $text_disabled; ?></option>
                    <?php } else { ?>
                    <option value="1"><?php echo $text_enabled; ?></option>
                    <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_sort_order; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="cardlink_sort_order" value="<?php echo $cardlink_sort_order; ?>" placeholder="<?php echo $entry_sort_order; ?>" id="input-sort-order" class="form-control"/>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>