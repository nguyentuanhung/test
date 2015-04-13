<%
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         3.0.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$wantedOptions = array_flip(['length', 'limit', 'default', 'unsigned', 'null']);
$tableMethod = $this->Migration->tableMethod($action);
$columnMethod = $this->Migration->columnMethod($action);
$indexMethod = $this->Migration->indexMethod($action);
%>
<?php
use Phinx\Migration\AbstractMigration;

class <%= $name %> extends AbstractMigration
{
    public function up()
    {
    <%- foreach ($tables as $table): %>
        <%- $primaryKeys = $this->Migration->primaryKeys($table);
        $specialPk = count($primaryKeys) > 1 || $primaryKeys[0]['name'] !== 'id' || $primaryKeys[0]['info']['columnType'] !== 'integer';
        if ($specialPk) {
        %>
        $table = $this->table('<%= $table%>', ['id' => false, 'primary_key' => ['<%= implode("', '", \Cake\Utility\Hash::extract($primaryKeys, '{n}.name')) %>']]);
        <%- } else { %>
        $table = $this->table('<%= $table%>');
        <%- } %>
        $table
        <%- if ($specialPk) { %>
            <%- foreach ($primaryKeys as $primaryKey) :%>
            -><%= $columnMethod %>('<%= $primaryKey['name'] %>', '<%= $primaryKey['info']['columnType'] %>', [<%
                $options = [];
                $columnOptions = array_intersect_key($primaryKey['info']['options'], $wantedOptions);
                echo $this->Migration->stringifyList($columnOptions, ['indent' => 4]);
            %>])
            <%- endforeach; %>
        <%- } %>
        <%- foreach ($this->Migration->columns($table) as $column => $config): %>
            -><%= $columnMethod %>('<%= $column %>', '<%= $config['columnType'] %>', [<%
                $options = [];
                $columnOptions = array_intersect_key($config['options'], $wantedOptions);
                echo $this->Migration->stringifyList($columnOptions, ['indent' => 4]);
            %>])
        <%- endforeach; %>
            -><%= $tableMethod %>();
    <%- endforeach; %>
    }

    public function down()
    {
        <%- foreach ($tables as $table): %>
        $this->dropTable('<%= $table%>');
        <%- endforeach; %>
    }
}
