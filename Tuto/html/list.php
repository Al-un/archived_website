<?php
include("../tools/header.php");
?>

<h1> HTML </h1>
<h2> Les Listes </h2>
	
<!---------- Liste &agrave; puce ------------->
  <h4> Liste &agrave; puce </h4>
		
 <pre class = "code">
  &lt;ul&gt;
    &lt;li&gt; &eacute;lement 1 &lt;/li&gt;
    &lt;li&gt; &eacute;l&eacute;ment 2 &lt;/li&gt;
    &lt;li&gt; ... &lt;/li&gt;
  &lt;/ul&gt;
 </pre>
		
  <ul class = "render">
    <li> &eacute;lement 1 </li>
    <li> &eacute;l&eacute;ment 2 </li>
    <li> ... </li>
  </ul>
		
		
<!------------- Liste num&eacute;rot&eacute;e ------->
  <h4> Liste num&eacute;rot&eacute;e </h4>	
			
  <pre class = "code">
  &lt;ol&gt;
    &lt;li&gt; &eacute;lement 1 &lt;/li&gt;
    &lt;li&gt; &eacute;l&eacute;ment 2 &lt;/li&gt;
    &lt;li&gt; ... &lt;/li&gt;
  &lt;/ol&gt;</pre>
		
  <ol class = "render">
    <li> &eacute;lement 1 </li>
    <li> &eacute;l&eacute;ment 2 </li>
    <li> ... </li>
  </ol>
		
	
<!------------ Liste  de d&eacute;finition --->
  <h4> Liste de d7eacute;finition </h4>
		
  <pre class = "code">
  &lt;dl&gt;
    &lt;dt&gt; Titre 1 &lt;/dt&gt;
    &lt;dd&gt; D&eacute;finition 1 &lt;/dd&gt;
    &lt;dt&gt; Titre 2 &lt;/dt&gt;
    &lt;dd&gt; D&eacute;finition 2 &lt;/dd&gt;
    &lt;dt&gt; ... &lt;/dt&gt;
    &lt;dd&gt; ... &lt;/dd&gt;
  &lt;/dl&gt;				
		</pre>
		
  <dl class = "render">
    <dt> Titre1 </dt>
    <dd> D&eacute;finition 1 </dd>
    <dt> Titre 2 </dt>
    <dd> D&eacute;finition 2 </dd>
    <dt> ... </dt>
    <dd> ... </dd>
  </dl>

<?php
include("../tools/footer.php");
?>