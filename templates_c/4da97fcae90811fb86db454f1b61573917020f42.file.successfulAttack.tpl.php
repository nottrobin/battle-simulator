<?php /* Smarty version Smarty-3.1.8, created on 2012-05-03 15:26:07
         compiled from "templates/successfulAttack.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5613766674fa278666d73a0-20238914%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4da97fcae90811fb86db454f1b61573917020f42' => 
    array (
      0 => 'templates/successfulAttack.tpl',
      1 => 1336055060,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5613766674fa278666d73a0-20238914',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_4fa278666f1611_94404883',
  'variables' => 
  array (
    'attacker' => 0,
    'verb' => 0,
    'weaponAdjective' => 0,
    'noun' => 0,
    'appendix' => 0,
    'defender' => 0,
    'attackStrength' => 0,
    'defence' => 0,
    'damage' => 0,
    'health' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fa278666f1611_94404883')) {function content_4fa278666f1611_94404883($_smarty_tpl) {?><?php echo $_smarty_tpl->tpl_vars['attacker']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['verb']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['weaponAdjective']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['noun']->value;?>
 of <?php echo $_smarty_tpl->tpl_vars['appendix']->value;?>
 at <?php echo $_smarty_tpl->tpl_vars['defender']->value;?>
. Got 'em!
Attack strength: <?php echo $_smarty_tpl->tpl_vars['attackStrength']->value;?>

Defence:         <?php echo $_smarty_tpl->tpl_vars['defence']->value;?>

Damage dealt:    <?php echo $_smarty_tpl->tpl_vars['damage']->value;?>


<?php echo $_smarty_tpl->tpl_vars['defender']->value;?>
 now has <?php echo $_smarty_tpl->tpl_vars['health']->value;?>
 health.
<?php }} ?>