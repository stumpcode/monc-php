<?php


/**
 * Created by IntelliJ IDEA.
 * User: apple
 * Date: 14/11/30
 * Time: 上午8:07
 */
class MPager extends MComponent {

    /**
     * @var MPagination
     */
    public $pagination;

    /**
     * @var integer maximum number of page buttons that can be displayed.
     */
    public $maxButtonCount = 5;
    /**
     * @var string the text label for the next page button.
     */
    public $nextPageLabel;
    /**
     * @var string the text label for the previous page button.
     */
    public $prevPageLabel;
    /**
     * @var string the text label for the first page button.
     */
    public $firstPageLabel;
    /**
     * @var string the text label for the last page button.
     */
    public $lastPageLabel;

    /**
     * @var boolean whether the "first" and "last" buttons should be hidden.
     * Defaults to false.
     */
    public $hideFirstAndLast = false;
    /**
     * @var array HTML attributes for the pager container tag.
     */
    public $htmlOptions = array ();

    /**
     * @param $opts
     * @return MPager
     */
    static function getInstance($opts) {

        $pager = new MPager();
        foreach ($opts as $key => $one) {
            $pager->$key = $one;
        }

        return $pager;
    }

    function render() {
        $links = $this->createPageLinks();
        if (!empty($links)) {
            return MHtml::pagination($links, $this->htmlOptions);
        }
    }

    protected function createPageLinks() {
        if ($this->nextPageLabel === null) {
            $this->nextPageLabel = '下一页 &gt;';
        }

        if ($this->prevPageLabel === null) {
            $this->prevPageLabel = '&lt; 上一页';
        }

        if ($this->firstPageLabel === null) {
            $this->firstPageLabel = '&lt;&lt; 首页';
        }

        if ($this->lastPageLabel === null) {
            $this->lastPageLabel = '尾页 &gt;&gt;';
        }

        if (($pageCount = $this->getPageCount()) <= 1) {
            return array ();
        }

        list($beginPage, $endPage) = $this->getPageRange();

        $currentPage = $this->getCurrentPage(false); // currentPage is calculated in getPageRange()
        $links = array ();

        // first page
        if (!$this->hideFirstAndLast) {
            $links[] = $this->createPageLink($this->firstPageLabel, 0, $currentPage <= 0, false);
        }

        // prev page
        if (($page = $currentPage - 1) < 0) {
            $page = 0;
        }

        $links[] = $this->createPageLink($this->prevPageLabel, $page, $currentPage <= 0, false);

        // internal pages
        for ($i = $beginPage; $i <= $endPage; ++$i) {
            $links[] = $this->createPageLink($i + 1, $i, false, $i == $currentPage);
        }

        // next page
        if (($page = $currentPage + 1) >= $pageCount - 1) {
            $page = $pageCount - 1;
        }

        $links[] = $this->createPageLink(
            $this->nextPageLabel,
            $page,
            $currentPage >= $pageCount - 1,
            false
        );

        // last page
        if (!$this->hideFirstAndLast) {
            $links[] = $this->createPageLink(
                $this->lastPageLabel,
                $pageCount - 1,
                $currentPage >= $pageCount - 1,
                false
            );
        }

        return $links;
    }

    protected function getPageRange() {
        $currentPage = $this->getCurrentPage();
        $pageCount = $this->getPageCount();
        $beginPage = max(0, $currentPage - (int) ($this->maxButtonCount / 2));
        if (($endPage = $beginPage + $this->maxButtonCount - 1) >= $pageCount) {
            $endPage = $pageCount - 1;
            $beginPage = max(0, $endPage - $this->maxButtonCount + 1);
        }
        return array ($beginPage, $endPage);
    }

    protected function createPageLink($label, $page, $disabled, $active) {
        return array (
            'label' => $label,
            'url' => $this->createPageUrl($page),
            'disabled' => $disabled,
            'active' => $active,
        );
    }

    protected function createPageUrl($page) {
        return $this->getPagination()->createPageUrl(Monc::app()->controller, $page);
    }

    public function getCurrentPage($recalculate = true) {
        return $this->getPagination()->getCurrentPage($recalculate);
    }

    public function setCurrentPage($value) {
        $this->getPagination()->setCurrentPage($value);
    }

    public function getPageSize() {
        return $this->getPagination()->getPageSize();
    }

    /**
     * @param integer $value number of items in each page
     * @see MPagination::setPageSize
     */
    public function setPageSize($value) {
        $this->getPagination()->setPageSize($value);
    }

    /**
     * @return integer total number of items.
     * @see MPagination::getItemCount
     */
    public function getItemCount() {
        return $this->getPagination()->getItemCount();
    }

    /**
     * @param integer $value total number of items.
     * @see MPagination::setItemCount
     */
    public function setItemCount($value) {
        $this->getPagination()->setItemCount($value);
    }

    /**
     * @return integer number of pages
     * @see MPagination::getPageCount
     */
    public function getPageCount() {
        return $this->getPagination()->getPageCount();
    }


    /**
     * @return MPagination
     */
    public function getPagination() {
        return $this->pagination;
    }
}
