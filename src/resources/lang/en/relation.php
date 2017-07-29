<?php

return [
    'relationOperation'     => 'Relation Operation',
    'selectAdd'             => 'Select & Add',
    'custom'                => 'Custom',
    'handsUp'               => 'Hands Up!',
    'turnOff'               => 'You can turn off this function (relation operation) in config file.',
    'functionDescription'   => 'Function Description: When the rule is matched, the extra action will be completed',
    'tooltip'               => 'Tooltips',
    'exampleCustom'         => 'Example of Custom operation',
    'customExplain'         => '<span class="red">
                            Warning: The custom rule name will be the function name which you will manually program with
                        </span><br>
                        You can customize any rule, set the correct table and field that can receive the right data for special operation <br>
                        <span class="blue">
                            Advantage: delete action will follow the rule you make (no long active field match response field). The rule such as
                            when delete record from active table then all the records will be deleted base on response field match custom rule
                        </span>',
    'ruleName'              => 'Rule Name',
    'functionName'          => 'Will be method name you are going to program, has to be valid function name',
    'action'                => 'Action',
    'operationType'         => 'Please select an operation type',
    'edit'                  => 'Edit',
    'delete'                => 'Delete',
    'actionInfo'            => 'What action will trigger the relation operation',
    'activeTable'           => 'Active Table',
    'activeTableInfo'       => 'The record that you are going to operate from which table',
    'activeFieldInfo'       => 'The field from active table',
    'responseTableInfo'     => 'Which table will be related to operation of active table\'s record',
    'responseFieldInfo'     => 'This field will match active filed to achieve operation of relation',
    'advantageInfo'         => 'Set the rule to match active field for operation of records',
    'targetValuePh'         => 'This value will be matched to response field',
    'targetValueInfo'       => 'Please set correct type of value to match response field. TRUE:1 FALSE:0',
    'choose'                => 'Click to Choose...',
    'activeField'           => 'Active Field',
    'selectActiveTable'     => 'select active table',
    'responseTable'         => 'Response Table',
    'responseField'         => 'Response Field',
    'selectResponseTable'   => 'select response table',
    'matchActiveField'      => 'This field will match active field to achieve operation of relation',
    'advantage'             => 'Advantage',
    'operation'             => 'Operation',
    'targetValue'           => 'Target Value',
    'setCorrectType'        => 'Please set correct type of value to match response field. TRUE:1 FALSE:0',
    'detail'                => 'Detail',
    'add'                   => 'Add',
    'back'                  => 'Back',
    'functionDescription2'  => 'Function Description: When the rule is matched, the action will be held',
    'exitOperation'         => 'Example of Exist Operation',
    'existExplain'          => '<span class="red">
                            Warning: This function is not operating other tables only current active table will be operated come with the customized rule<br>
                            Warning: The rule is only: active field compare with response field or response field compare with custom value
                        </span><br>
                        Operating current table (active table) only according the rule you make. The rule is checking other tables <br>
                        Before do a action (delete, edit a record) the rule will be applied.<br>
                        For example: there are user table and user\'s article table. If you want to delete a user then check article table to make sure no article belongs user.
                        you can set the rule, active table - user, active field - id, response table - article, response field - user_id.<br>
                        <span class="blue">
                            Advantage: delete action will follow the rule you make (no long active field match response field). The rule such as
                            when delete record from active table then all the records will be deleted base on response field match custom rule
                        </span>',
    'deleteInterlock'       => 'Delete Interlock',
    'actionDelete'          => 'Action: Delete',
    'extraOperation'        => 'Extra operation: effect other tables',
    'relatedOtherTable'     => 'Related to other tables',
    'interlockInfo'         => 'After you delete one record and all the records from another tables will be deleted according to the rules you make',
    'interlockExample'      => 'Example: article and comments - when an article is deleted then all the comments will be deleted. Or delete a user and all the data from different table relative user will be deleted',
    'next'                  => 'Next',
    'exist'                 => 'Exist',
    'actionDeleteEdit'      => 'Action: Delete Edit',
    'existInfo'             => 'Check the field from another tables and the rules have to be matched before activate the main action (button available)',
    'existExample'          => 'Example: article and its classification - before deleting an article\'s classification you want to check if there any article still use this classification (prevent pointing a data does not exist)',
    'selfCheckInfo'         => 'Check the specific field to match the rule from the table itself(not other table) before the execute the main action',
    'selfCheckExample'      => 'Example: article - this table has a field is marked publish, for protecting un-publish article you can set rule that any action will be execute only when the article has been published',
    'customInfo'            => 'Custom rules to achieve specific function, need to program your own code, rule\'s name is the function name',
    'customExample'         => 'Example: After a article get deleted and the number of amount of that author\'s article will be subtract by one (article table and amount of article may not be the same table)',
    'interlock'             => 'Interlock',
    'functionDescription3'  => 'Function Description: When the rule is matched, the extra action will be completed',
    'interlockDelete'       => 'Example of interlock delete',
    'interlockExplain'      => 'user table has fields id, user_name<br>
                        article table has fields id, user_id, article_title, content<br>
                        Now you want when delete a user and all the user\'s article get deleted as well, you can set
                        active table: user,
                        active field: id,
                        response table: article,
                        response filed: user_id (normally is foreign key)<br>
                        <span class="blue">
                            Advantage: delete action will follow the rule you make (no long active field match response field). The rule such as
                            when delete record from active table then all the records will be deleted base on response field match custom rule
                        </span>',
    'selfCheckOperation'    => 'Example of SelfCheck Operation',
    'selfCheckExplain'      => '<span class="red">
                            Warning: This function is not operating other tables only current active table will be operated come with the customized rule<br>
                            Warning: The rule is only: active field compare with custom value
                        </span><br>
                        Operating current table (active table) only according the rule you make. The rule is checking current table itself <br>
                        Before do a action (delete, edit a record) the rule will be applied.<br>
                        For example: there are items with the property of 1-5 stars in the table. You want to protect all the items which has 5 stars from deleting. So set the rule: active table - items, active field - stars, operation - "=", target value - "5"<br>',
    'selfCheck' => 'Self Check'
];