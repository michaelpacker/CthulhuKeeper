<?php
	session_start();
	$page_title='Combat Helper';
	require "includes/header.inc.php";
?>
<style>
	.combat-helper-form {
		font-size: 120%;
	}
	.combat-helper {
		margin: 0 auto;
		max-width: 800px;
	}
	.two-column {
		display: grid;
		grid-template-columns: 50% 50%;
		grid-template-rows: auto;
		gap: 20px 40px;
	}
	.three-column {
		display: grid;
		grid-template-columns: 33% 33% 33%;
		grid-template-rows: auto;
		gap: 20px 10px;
	}
	aside {
		margin-top: 100px;
		font-size: .8em;
	}
	fieldset {
		margin-bottom: 20px;
	}
	.form-list {
		margin: 0;
		padding: 0;
		list-style-type: none;
	}
	.form-list li {
		margin-bottom: 1em;
	}
	.rules-clarification {
		margin: 60px auto 60px auto;
		max-width: 600px;
		background: #efefef;
		padding: 20px 40px;
		border-radius: 4px;
	}
	label.disabled {
		color: #ccc;
	}
	.conditional {
		margin-top: 20px;
		margin-left: 40px;
	}
	.roll-summary {
		padding: 20px 40px;
		background: #efefef;
		font-size: 1.2em;
		text-align: center;
        border-radius: 4px;
        font-weight: bold;
        margin-bottom: 40px;
	}
	.target {
		padding: 20px;
		background-color: #efefef;
	}
	.form-list.nested {margin-top: 20px; margin-left: 20px; }
	.pointBlankModalContainer.combatHelper {
		max-width: 600px;
	}
	.pointBlankModalContainer.combatHelper h1.modalTitle {
		text-align: left;
	}
	.pointBlankModalContainer.combatHelper .actionBar {
		width: 100%;
	}
	.pointBlankModalContainer.combatHelper .actionBar button {
		display: inline;
		margin-right: 20px;
    }
    .three-column.form-group {
        margin-bottom: 20px;
    }
    .tablulate-container {
        margin-top: 20px;
        margin-bottom: 40px;
    }
</style>
<div class="combat-helper">
	<script src="www/js/combat_helper2.js"></script>
	<h2>Combat Helper</h2>
	<!-- <a href="https://morganhua.blogspot.com/2017/06/call-of-cthulhu-7th-ed-combat-q.html">Interview with rules author</a> -->

	<form class="combat-helper-form" action="" method="">
		<div id="combat-start" class="helper-fork combat-step-container">
			<fieldset>
				<legend>Chose an attack</legend>
				<ul class="form-list">
					<li><label><input type="radio" name="attacker-action" value="melee"> Melee</label></li>
					<li><label><input type="radio" name="attacker-action" value="firearms"> Firearms</label>
						<ul id="weapon-type-list" class="form-list nested" hidden>
							<li><label><input type="radio" name="firearm-type" value="handgun-rifle"> Handgun or rifle</label></li>
							<li><label><input type="radio" name="firearm-type" value="shotgun"> Shotgun</label></li>
							<li><label><input type="radio" name="firearm-type" value="smg-mg"> Sub-machine gun or machine gun</label></li>
						</ul>
					</li>
				</ul>
			</fieldset>
			<div class="button-container">
				<button type="button" id="combat-start-submit">Next</button>
			</div>
		</div>
		<!-- Melee attacks -->
		<div id="combat-melee-attack" class="combat-step-container" hidden>
			<h3>Melee attack</h3>
			<div class="two-column">
				<fieldset class="attacker-action">
					<legend>The attacker is performing...</legend>
					<label><input type="radio" id="A1" name="attacker-fight-action" value="A1"> A melee attack</label>
					<label><input type="radio" id="A2" name="attacker-fight-action" value="A2"> A fighting maneuver</label>
					<p><strong>Melee attacks</strong> are any attack with a part of the body  (fists, feet, head, etc), or a melee weapon (club, knife, sword, chainsaw, etc), where the intent is to do harm or knock-out.</p>
					<p>A <strong>fighting maneuver</strong> attack is any attempt to grapple, wrestle, tickle, push, restrain, disarm, or otherwise disrupt the opponent through physical means without causing direct harm.</p>
				</fieldset>
				<fieldset class="defender-action">
					<legend>The defender can respond by...</legend>
					<label><input type="radio" name="defender-fight-action" value="D1"> Fighting back</label>
					<label><input type="radio" name="defender-fight-action" value="D2"> Dodging</label>
					<label><input type="radio" name="defender-fight-action" value="D3"> Attempting a fighting maneuver</label>
					<label><input type="radio" name="defender-fight-action" value="D4"> Doing nothing</label>

					<p><strong>Fighting back</strong> is the intent to cause harm to the attacker while leaving ones self open to an attack. An "impale" does not do bonus damage when fighting back. Typically the skill for Fighting Back is <strong>Fighting (Brawl)</strong>.</p>
					<p><strong>Dodge</strong> is the attempt to get out of harms way when in melee combat. The <strong>Dodge</strong> skill is rolled.</p>
					<p>A <strong>fighting maneuver</strong>, when defending, is any attempt to graple, wrestle, tickle, push, restrain, disarm, or otherwise disrupt the attacker through physical means without causing direct harm.</p>
					<p><strong>Doing Nothing</strong>: A defender can only fight back, dodge or perform a fighting maneuver as part of their defensive action so many times. If the defender only has 1 attack per round, they can only "defend" from one attack per round. Doing nothing/not being able to respond is an option. The attacker rolls and the defender hopes for the best.</p>
				</fieldset>
			</div>
			<div class="button-container">
				<button type="button" id="combat-melee-submit">Next</button>
			</div>
		</div>
		<!-- Figthing maneuver -->
		<div id="combat-melee-maneuver" class="combat-step-container" hidden>
			<h3>Fighting maneuver</h3>
			<p>Fighting Maneuvers depend on things like leverage to accomplish their goals. If the defender is too big, the maneuver may be impossible.</p>

			<h4>First compare build scores</h4>
			
			<p>The person initiating the maneuver compares their Build to the target.</p>
			<ul>
				<li>If Build scores are equal, then no penalty is applied</li>
				<li>If the Build of the initiator is 1 less than the target, then 1 penalty die is applied.</li>
				<li>If the Build of the initiator is 2 less than the target, then 2 penalty dice are applied.</li>
				<li>If the Build of the initiator is 3 less or more than the target, then the maneuver is considered impossible.</li>
			</ul>
			<p>There are no bonus dice if the initiator is larger than the target. I know - it doesn't make sense, but thems the rules.</p>
			<div class="button-container">
				<button type="button" id="combat-maneuver-submit">Next</button>
			</div>
		</div>
		<!-- Resolve combat -->
		<div id="combat-melee-resolve" class="combat-step-container" hidden>
		<div class="result-a1d1 result-set" hidden>
				<h3>Physical Attack against a Defender who is Fighting Back</h3>
				<p>Both combatants roll <strong>Fighting (Brawl)</strong>*.</p>
				<p>The highest <em>level of success (Regular, Hard, Extreme)</em> wins!</p>
				<p>Attacker wins in a tie and damage is inflicted.</p>
				<p>If defender wins with a higher <em>level of success (Regular, Hard, Extreme)</em>, the attack is countered and damage is inflicted upon the attacker.</p>
				<p>If both fail, nothing happens.</p>
			</div>
			
			<div class="result-a1d2 result-set" hidden>
				<h3>Physical Attack against a Defender who is Dodging</h3>
				<p>Attacker rolls <strong>Fighting (Brawl)</strong>*.</p>
				<p>Defender rolls <strong>Dodge</strong>.</p>
				<p>Attacker wins with a higher <em>level of success (Regular, Hard, Extreme)</em> and inflicts damage.</p>
				<p>Defender wins with a higher <em>level of success (Regular, Hard, Extreme)</em> or if they tie the level of success; the attack is dodged and no damage is inflicted.</p>
				<p>If both fail, nothing happens.</p>
			</div>

			<div class="result-a1d3 result-set" hidden>
				<h3>Physical Attack against a Defender who is performing a Fighting Maneuver</h3>
				<p>Compare Build scores and determine penalty dice (if any).</p>
				<p>Both combatants roll <strong>Fighting (Brawl)</strong>*.</p>
				<p>The highest <em>level of success (Regular, Hard, Extreme)</em> wins!</p> 
				<p>Attacker wins in a tie.</p>
				<p>If the defender wins with a higher <em>level of success (Regular, Hard, Extreme)</em>, the attack fails and their fighting maneuver is successful.</p>
				<p>If both fail, nothing happens.</p>
			</div>
			<div class="result-a1d4 result-set" hidden>
				<h3>Physical Attack against a Defender who is doing nothing</h3>
				<p>Attacker rolls <strong>Fighting (Brawl)</strong>*.</p>
				<p>A success means that damage has been inflicted.</p>
			</div>

			<div class="result-a2d1 result-set" hidden>
				<h3>Fighting Maneuver Attack against a Defender who is Fighting Back</h3>
				<p>Compare Build scores and determine penalty dice (if any).</p>
				<p>Both combatants roll <strong>Fighting (Brawl)</strong>*.</p>
				<p>Attacker wins with a higher <em>level of success (Regular, Hard, Extreme)</em>. Attacker wins in a tie and the maneuver is successful.</p>
				<p>If the defender wins with a higher <em>level of success (Regular, Hard, Extreme)</em>, the attacker's maneuver fails and the defender inflicts damage.</p>
				<p>If both fail, nothing happens.</p>
			</div>

			<div class="result-a2d2 result-set" hidden>
				<h3>Fighting Maneuver Attack against a Defender who is Dodging</h3>
				<p>Compare Build scores and determine penalty dice (if any).</p>
				<p>Attacker rolls <strong>Fighting (Brawl)</strong>*. Defender rolls <strong>Dodge</strong>.</p>
				<p>Attacker wins with a higher <em>level of success (Regular, Hard, Extreme)</em>. The maneuver is successful.</p>
				<p>The defender wins with a higher <em>level of success (Regular, Hard, Extreme)</em> or a tie. The maneuver is dodged and nothing happens.</p>
				<p>If both fail, nothing happens.</p>
			</div>
			
			<div class="result-a2d3 result-set" hidden>
				<h3>Fighting Maneuver Attack against a Defender who is performing a Fighting Maneuver</h3>
				<p>Compare Build scores and determine penalty dice (if any).</p>
				<p>Both combatants roll <strong>Fighting (Brawl)</strong>*.</p>
				<p>The highest <em>level of success (Regular, Hard, Extreme)</em> wins! Attacker wins in a tie and their maneuver is successful.</p>
				<p>If defender wins with a higher <em>level of success (Regular, Hard, Extreme)</em>, their maneuver against the attacker is successful.</p>
				<p>If both fail, nothing happens.</p>
			</div>
			<div class="result-a2d4 result-set" hidden>
				<h3>Fighting Maneuver against a Defender who is doing nothing</h3>
				<p>Attacker rolls <strong>Fighting (Brawl)</strong>*.</p>
				<p>A success means that the effects of the maneuver are applied.</p>
			</div>
			<div class="button-container">
				<button type="button" id="combat-reset-melee">Start over</button>
			</div>
		</div>

		<!-- -->
		<!-- FIREARMS RIFLE HANDGUN -->
		<!-- -->
		<div id="combat-firearms-range" class="combat-step-container" hidden>
			<h3>Firearm attack - determine range</h3>
			<fieldset>
				<legend>What's the range?</legend>
				<ul class="form-list">
					<li><label><input type="radio" name="shooting-range" value="R1"> Point-blank range</label></li>
					<li><label><input type="radio" name="shooting-range" value="R2"> Within base range</label></li>
					<li><label><input type="radio" name="shooting-range" value="R3"> Long range (more than base, but less than 2x base range)</label></li>
					<li><label><input type="radio" name="shooting-range" value="R4"> Very long range (more than long range, but less than 4x base range)</label></li>
				</ul>			
			</fieldset>
			<div class="button-container">
				<button type="button" id="combat-firearms-range-submit">Next: Determine Bonus or Penalty Dice</button>
			</div>
			<div class="rules-clarification">
				<h4>Example</h4>
				<p>A .22 Short Automatic has a <strong>Base range of 10 yards.</strong></p>
				<p><strong>Long range is between 10.01 yards and 20 yards</strong> for the same weapon.</p>
				<p><strong>Very long range is between 20.01 yards and 40 yards</strong> for the same weapon.</p>
				<p>A .22 Short Automatic cannot reasonably hit anything beyond 40.01 yards.</p>
				<p><strong>Point-blank range is the characters DEX/5 in feet (rounded down)</strong> regardless of the weapon.</p>
			</div>
		</div>
		<!-- Determine penalties -->
		<div id="combat-firearms-modifiers" class="combtat-step-container" hidden>
			<h3>Determine Bonus or Penalty Dice</h3>
			<div class="two-column">
				<fieldset>
					<legend>Bonus Dice</legend>
					<ul class="form-list">
						<li><label><input type="checkbox" name="shooting-bonus" value="b1" disabled aria-disabled="true"> Point-blank range (DEX/5 feet)</label></li>
						<li><label><input type="checkbox" name="shooting-bonus" value="b2"> Aimed shot (1 full round to aim)</label></li>
						<li><label><input type="checkbox" name="shooting-bonus" value="b3"> Large target (BUILD 4+ or more)</label></li>
					</ul>
				</fieldset>
				<fieldset>
					<legend>Penalty Dice</legend>
					<ul class="form-list">
						<li><label><input type="checkbox" name="shooting-penalty" value="p1"> Target dove for cover successfully (Target rolls DODGE)</label></li>
						<li><label><input type="checkbox" name="shooting-penalty" value="p2"> Target has cover (50% or more of target is concealed)</label></li>
						<li><label><input type="checkbox" name="shooting-penalty" value="p3"> Reload and shoot (Hip shot)</label></li>
						<li class="multiple-rounds-check"><label><input type="checkbox" name="shooting-penalty" value="p4"> Multiple shots (semi-auto burst, double barrels)</label></li>
						<li><label><input type="checkbox" name="shooting-penalty" value="p5"> Firing into Melee Combat (including self)**</label></li>
						<li><label><input type="checkbox" name="shooting-penalty" value="p6"> Fast-moving target (Mov 8+) - Target has made a full move</label></li>
						<li><label><input type="checkbox" name="shooting-penalty" value="p7"> Small size (BUILD -2 or less)</label></li>
					</ul>
				</fieldset>
			</div>
			<div class="button-container">
				<button type="button" id="combat-firearms-modifiers-submit">Next</button>
			</div>
		</div>
		<!-- ROLL TO FIRE -->
		<div id="combat-firearms-resolve" class="combat-step-container" hidden>
			<h3>Roll to Fire!</h3>
			<div class="roll-summary" aria-live="polite">
			</div>

			<div class="button-container">
				<button type="button" id="combat-reset-firearms">Start over</button>
			</div>
		</div>
		
		<!-- FIREARMS - FULL AUTO - STEP 1 -->
		<div id="mg-setup" class="combat-step-container shooting-autofire-step1" hidden>
			<h3>Sub-Machine Guns and Machine Guns</h3>
			<fieldset id="mg-round-select">
				<legend>How many rounds?</legend>
				<ul class="form-list">
					<li><label><input type="radio" name="mg-round-type" value="MG1"> Single shot</label></li>
					<li><label><input type="radio" name="mg-round-type" value="MG2"> Single burst (single volley of 2 or 3 rounds)</label></li>
					<li><label><input type="radio" name="mg-round-type" value="MG3"> Full-auto (multiple volleys)</label></li>
				</ul>
			</fieldset>
			<div id="full-auto-setup" hidden>
				<div class="three-column">
					<div class="form-group">
						<label for="target-count">How many targets?</label>
						<input type="number" min="1" max="12" id="target-count" value="">
					</div>
					<div class="form-group">
						<label for="bullet-count">How many total rounds?</label>
						<input type="number" min="1" max="4000" id="bullet-count" value="">
					</div>
					<div class="form-group">
						<label for="smg-skill">Investigator's SMG skill</label>
						<input type="number" min="1" max="99" id="smg-skill" value="">
					</div>
				</div>
				<div class="tablulate-container">
					<button type="button" class="fullauto-calculate">Calculate volley size</button>
				</div>
				<div class="fire-results">
				</div>
			</div>
			<div class="button-container">
				<button type="button" id="mg-submit">Next: Roll to fire!</button>
			</div>
		</div>
		
		
	</form>
	<div class="successes">
		<aside>
		<p>More than two penalty dice will increase the difficulty by one level.</p>
		<p><strong>Regular success:</strong> when the player rolls under their skill number. For a skill of 50, any roll of 50 or under would be a regular success.</p>
		<p><strong>Hard success:</strong> when the player rolls under <em>half</em> of their skill number. For a skill of 50, any roll of 25 and under would be a hard success.</p>
		<p><strong>Extreme success:</strong> when the player rolls under <em>one-fifth</em> of their skill number. For a skill of 50, any roll of 10 and under would be an extreme success.</p>
		<p><strong>Critical success/failure:</strong> a roll of 01 is considered a critical success. A roll of 100 is considered a critical failure or a "fumble".</p>
		<p><strong>Malfunction:</strong> firearms have a malfunction number, which is not the same as a critical failure/fumble. 
		<p>* If the attacker or defender is using specialized weapon, such as a chainsaw, they would roll under their specified skill instead (e.g. Fighting (Chainsaw)). Fighting maneuvers always use Fighting (Brawl).</p>
		<p>** Firing into melee is risky. A critical failure (fumble) means that an ally has been hit. In the case of multiple allies engaged in melee, the player with the lowest Luck score is hit.</p>
		</aside>
	</div>
</div>
<div class="modalOverlay" hidden>
	<div class="modalContainer pointBlankModalContainer combatHelper" role="dialog" aria-labelledby="pointBlankModalTitle">
		<h1 id="pointBlankModalTitle" class="modalTitle">Point blank range and melee combat</h1>
		<p>Firing into melee combat negates any bonus for point blank range.</p>
		<div class="formGroup actionBar">
			<button class="positive action" type="button" id="pbModalOK">OK, fire into melee</button><button class="negative action" type="button" id="pbModalCancel">Let me reconsider</button>
		</div>
	</div>
</div>

<?php
	require "includes/footer.inc.php";
?>