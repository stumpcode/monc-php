<?php


/**
 * Created by IntelliJ IDEA.
 * User: apple
 * Date: 14/12/7
 * Time: 下午8:59
 */
class ModelView extends MComponent {

    /**
     * @var MDbModel
     */
    public $model;
    public $columns = array ();

    function __construct($opts) {

        $this->applyOptions($opts);
    }

    function render() {

        $strTr = "";
        $names = $this->model->labels();

        $data = $this->model->getAttributes();
        if ($columns = $this->columns) {

            $data1 = array ();
            foreach ($columns as $one) {
                if (is_string($one)) {
                    $data1[$one] = $data[$one];
                    continue;
                }
                if (is_array($one)) {
                    $opts = array_slice($one, 1);
                    $key = $one[0];
                    $value = isset($opts['type']) ?
                        app()->formatter->format($opts['type'], $data[$key],
                            isset($opts['htmlOptions']) ? $opts['htmlOptions'] : array ()) :
                        $data[$key];
                    $data1[$key] = $value;
                }
            }
            $data = $data1;
        }

        foreach ($data as $k => $v) {
            $strTr .= '<tr>
                <td class="view-key">' . $names[$k] . '</td>
                <td class="view-value">' . $v . '</td>
            </tr>';
        }

        return <<<eot
            <div class='model-view'>
                <table class='table table-hover'>
                    {$strTr}
                </table>
            </div>
eot;

    }

} 
