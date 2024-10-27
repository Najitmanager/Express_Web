<?php

namespace Modules\Warehouse\Http\Filter;


/**
 * Use this class to add filter on users in query database.
 */
class PortFilter
{

    /**
     * user query.
     * @var object
     */
    public $query;

    /**
     * request data.
     * @var object
     */
    public $request;


    public function __construct($query, $request)
    {
        $this->query = $query;
        $this->request = $request;

        return $this;
    }

    /**
     * request data.
     * @param array $key_filters {
     * @item string
     * }
     * @return query
     */
    public function filterBy(...$key_filters)
    {
        $filter = $this->request->filter;
        $query = $this->query;

        if ($filter) {
            $filter_array = is_array($key_filters[0]) ? $key_filters[0] : $key_filters;
            foreach ($filter_array as $key) {

                // country_id
                if ($key == 'country_id') {
                    if (isset($filter['country_id']) && $filter['country_id'] != '') {
                        $query->whereIn('country_id', $filter['country_id']);
                    }
                }
                // city
                if ($key == 'city') {
                    if (isset($filter['city']) && $filter['city'] != '') {
                        $query->whereIn('city', $filter['city']);
                    }
                }


                // name
                if ($key == 'name') {
                    if (isset($filter['name']) && $filter['name'] != '') {
                        $query->where('name', $filter['name']);
                    }
                }


                // check on created_at | filter table
                require app_path('Helpers/globalFilter/created_at.php');
            }
        }

        return $query;
    }
}
