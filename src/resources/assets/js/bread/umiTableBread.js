/*
 * 用于umi-table中的增删改事件, 或者任何地方需要调用这些事件功能的地方
 * common use for umi-table bread event, or anywhere else which need to invoke this bread function
 */

//显示添加确认页面
//show the confirmation page before adding
function showAdding(url) {
    layer.open({
        type: 2,
        title: 'Adding',
        maxmin: true,
        shadeClose: true,
        area: ['80%', '90%'],
        content: url
    });
}

//显示删除确认页面
//show the confirmation page before deleting
function showDeleting(url) {
    layer.open({
        type: 2,
        title: 'Deleting',
        maxmin: true,
        shadeClose: true,
        area: ['80%', '90%'],
        content: url
    });
}

//显示编辑确认页面
//show the confirmation page before editing
function showEditing(url) {
    layer.open({
        type: 2,
        title: 'Editing',
        maxmin: true,
        shadeClose: true,
        area: ['80%', '90%'],
        content: url
    });
}

//显示查看的页面
//show the read page
function showReading(url) {
    layer.open({
        type: 2,
        title: 'Reading',
        maxmin: true,
        shadeClose: true,
        area: ['80%', '90%'],
        content: url
    });
}