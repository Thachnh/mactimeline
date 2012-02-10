<?php


class mactimeline_views_handler_field_node_title_body extends views_handler_field {
  /**
   * Called to add the field to a query.
   */
  function query() {
    //$this->ensure_my_table();
    // Add the field.
    //$this->field_alias = $this->query->add_field($this->table_alias, $this->real_field);

    //$this->field_alias = $this->query->add_field($this->table_alias, 'title');
    //$this->field_alias_body = $this->query->add_field($this->table_alias, 'body');
  }


  /**
   * Render the field.
   *
   * @param $values
   *   The values retrieved from the database.
   */
  function render($values) {
    //print '<pre>' . print_r($values, true) . '</pre>';
    //die();

    //$title = $values->{'title'};
    //$body = $values->{'body'};
    //return '<b>' . check_plain($title) . '</b>' . check_plain($body);
    //return '<pre>' . check_plain(print_r(array$values, true)) . '</pre>';

    $pnid = $values->node_data_field_related_product_field_related_product_nid;
    $product = node_load($pnid);

    return '<b>' . l($product->title . ',', 'node/' . $pnid) . '</b>' . ' ' . l($values->node_title, 'node/' . $values->nid);
  }

}
