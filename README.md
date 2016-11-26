PAGINATION CLASS

Add pagination to your mysql query.

Example usage..
$rdata = filter_input_array(INPUT_GET);
$page = isset($rdata->page) ? $rdata->page : 1;
$radius = isset($rdata->radius) ? $rdata->radius : 5; //Miles..      
$no_items = isset($rdata->no_items) ? $rdata->no_items : 30;

$csql = "SELECT COUNT(*) AS count
 FROM {$this->table} AS p WHERE (p.longitude > 0 AND p.latitude > 0) AND SQRT(
 POW(69.1 * (latitude - {$rdata->lat}), 2) +
 POW(69.1 * ({$rdata->lng} - longitude) * COS(latitude / 57.3), 2)) < {$radius};";

$ctmp = $this->customQuery($csql);
$count = $ctmp[0]->count;

$pn = new yclPagination($count, $no_items, $page);
$sql_query = "SELECT bp.title, bp.description, bp.rating, bp.category, bp.phone_no, bp.website, bp.featured, bp.*,
 cat.featured_img AS category_img, bp.featured_img AS company_img, cat.title AS category_name, SQRT(
 POW(69.1 * (bp.latitude - {$rdata->lat}), 2) +
 POW(69.1 * ({$rdata->lng} - bp.longitude) * COS(bp.latitude / 57.3), 2)) AS distance
 FROM {$this->table} AS bp"
		. " INNER JOIN yel_categories AS cat ON cat.id = bp.category"
		. " HAVING (distance < {$radius} AND distance > 0 )"
		. " AND (bp.longitude > 0 AND bp.latitude > 0)"
		. " ORDER BY distance ASC LIMIT {$pn->getDBStartPoint()}, {$no_items};";

$result = $this->customQuery($sql_query);

$output = (object) array(
	"results" => $result,
	"pagination" => $pn
);

return $output;