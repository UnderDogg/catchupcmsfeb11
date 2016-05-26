@extends('themes.default1.installer.layout.installer')
@section('license')
active
@stop
@section('content')
        <center><h1>License Agreement</h1></center>

        <p>Please read this software license agreement carefully before downloading or using the software. By clicking on the "accept" button, opening the package, or downloading the product, you are consenting to be bound by this agreement. If you do not agree to all of the terms of this agreement, stop the installation process and exit.</p>
        <form action="{{URL::route('postlicence')}}" method="post">
            <div>
                
                <div id="openModal" class="modalDialog">
                    <div>
                        <a href="#close" title="Close" class="close">X</a>
                        <div div class="modal-body">
                            <h1>Open Software License v. 3.0 (OSL-3.0)</h1>
                        <p>This Open Software License (the &quot;License&quot;) applies to any original work of authorship (the &quot;Original Work&quot;) whose owner (the &quot;Licensor&quot;) has placed the following licensing notice adjacent to the copyright notice for the Original Work:</p>
                        <p>Licensed under the Open Software License version 3.0</p>
                        <p>1) <strong>Grant of Copyright License.</strong> Licensor grants You a worldwide, royalty-free, non-exclusive, sublicensable license, for the duration of the copyright, to do the following:</p>
                        <p>a) to reproduce the Original Work in copies, either alone or as part of a collective work;</p>
                        <p>b) to translate, adapt, alter, transform, modify, or arrange the Original Work, thereby creating derivative works (&quot;Derivative Works&quot;) based upon the Original Work;</p>
                        <p>c) to distribute or communicate copies of the Original Work and Derivative Works to the public, <u>with  the proviso that copies of Original Work or Derivative Works that You  distribute or communicate shall be licensed under this Open Software  License</u>;</p>
                        <p>d) to perform the Original Work publicly; and</p>
                        <p>e) to display the Original Work publicly.</p>
                        <p>2) <strong>Grant</strong> of Patent License. Licensor grants You a worldwide, royalty-free, non-exclusive, sublicensable license, under patent claims owned or controlled by the Licensor that are embodied in the Original Work as furnished by the Licensor, for the duration of the patents, to make, use, sell, offer for sale, have made, and import the Original Work and Derivative Works.</p>
                        <p>3) <strong>Grant</strong> of Source Code License. The term &quot;Source Code&quot; means the preferred form of the Original Work for making modifications to it and all available documentation describing how to modify the Original Work. Licensor agrees to provide a machine-readable copy of the Source Code of the Original Work along with each copy of the Original Work that Licensor distributes. Licensor reserves the right to satisfy this obligation by placing a machine-readable copy of the Source Code in an information repository reasonably calculated to permit inexpensive and convenient access by You for as long as Licensor continues to distribute the Original Work.</p>
                        <p>4) <strong>Exclusions From License Grant.</strong> Neither the names of Licensor, nor the names of any contributors to the Original Work, nor any of their trademarks or service marks, may be used to endorse or promote products derived from this Original Work without express prior permission of the Licensor. Except as expressly stated herein, nothing in this License grants any license to Licensor's trademarks, copyrights, patents, trade secrets or any other intellectual property. No patent license is granted to make, use, sell, offer for sale, have made, or import embodiments of any patent claims other than the licensed claims defined in Section 2. No license is granted to the trademarks of Licensor even if such marks are included in the Original Work. Nothing in this License shall be interpreted to prohibit Licensor from licensing under terms different from this License any Original Work that Licensor otherwise would have a right to license.</p>
                        <p>5) <strong>External Deployment.</strong> The term &quot;External Deployment&quot; means the use, distribution, or communication of the Original Work or Derivative Works in any way such that the Original Work or Derivative Works may be used by anyone other than You, whether those works are distributed or communicated to those persons or made available as an application intended for use over a network. As an express condition for the grants of license hereunder, You must treat any External Deployment by You of the Original Work or a Derivative Work as a distribution under section 1(c).</p>
                        <p>6) <strong>Attribution Rights.</strong> You must retain, in the Source Code of any Derivative Works that You create, all copyright, patent, or trademark notices from the Source Code of the Original Work, as well as any notices of licensing and any descriptive text identified therein as an &quot;Attribution Notice.&quot; You must cause the Source Code for any Derivative Works that You create to carry a prominent Attribution Notice reasonably calculated to inform recipients that You have modified the Original Work.</p>
                        <p>7) <strong>Warranty of Provenance and Disclaimer of Warranty.</strong> Licensor warrants that the copyright in and to the Original Work and the patent rights granted herein by Licensor are owned by the Licensor or are sublicensed to You under the terms of this License with the permission of the contributor(s) of those copyrights and patent rights. Except as expressly stated in the immediately preceding sentence, the Original Work is provided under this License on an &quot;AS IS&quot; BASIS and WITHOUT WARRANTY, either express or implied, including, without limitation, the warranties of non-infringement, merchantability or fitness for a particular purpose. THE ENTIRE RISK AS TO THE QUALITY OF THE ORIGINAL WORK IS WITH YOU. This DISCLAIMER OF WARRANTY constitutes an essential part of this License. No license to the Original Work is granted by this License except under this disclaimer.</p>
                        <p>8) <strong>Limitation of Liability.</strong> Under no circumstances and under no legal theory, whether in tort (including negligence), contract, or otherwise, shall the Licensor be liable to anyone for any indirect, special, incidental, or consequential damages of any character arising as a result of this License or the use of the Original Work including, without limitation, damages for loss of goodwill, work stoppage, computer failure or malfunction, or any and all other commercial damages or losses. This limitation of liability shall not apply to the extent applicable law prohibits such limitation.</p>
                        <p>9) <strong>Acceptance and Termination.</strong> If, at any time, You expressly assented to this License, that assent indicates your clear and irrevocable acceptance of this License and all of its terms and conditions. If You distribute or communicate copies of the Original Work or a Derivative Work, You must make a reasonable effort under the circumstances to obtain the express assent of recipients to the terms of this License. This License conditions your rights to undertake the activities listed in Section 1, including your right to create Derivative Works based upon the Original Work, and doing so without honoring these terms and conditions is prohibited by copyright law and international treaty. Nothing in this License is intended to affect copyright exceptions and limitations (including &quot;fair use&quot; or &quot;fair dealing&quot;). This License shall terminate immediately and You may no longer exercise any of the rights granted to You by this License upon your failure to honor the conditions in Section 1(c).</p>
                        <p>10) <strong>Termination for Patent Action.</strong> This License shall terminate automatically and You may no longer exercise any of the rights granted to You by this License as of the date You commence an action, including a cross-claim or counterclaim, against Licensor or any licensee alleging that the Original Work infringes a patent. This termination provision shall not apply for an action alleging patent infringement by combinations of the Original Work with other software or hardware.</p>
                        <p>11) <strong>Jurisdiction, Venue and Governing Law.</strong> Any action or suit relating to this License may be brought only in the courts of a jurisdiction wherein the Licensor resides or in which Licensor conducts its primary business, and under the laws of that jurisdiction excluding its conflict-of-law provisions. The application of the United Nations Convention on Contracts for the International Sale of Goods is expressly excluded. Any use of the Original Work outside the scope of this License or after its termination shall be subject to the requirements and penalties of copyright or patent law in the appropriate jurisdiction. This section shall survive the termination of this License.</p>
                        <p>12) <strong>Attorneys' Fees.</strong> In any action to enforce the terms of this License or seeking damages relating thereto, the prevailing party shall be entitled to recover its costs and expenses, including, without limitation, reasonable attorneys' fees and costs incurred in connection with such action, including any appeal of such action. This section shall survive the termination of this License.</p>
                        <p>13) <strong>Miscellaneous.</strong> If any provision of this License is held to be unenforceable, such provision shall be reformed only to the extent necessary to make it enforceable.</p>
                        <p>14) <strong>Definition of &quot;You&quot; in This License.</strong> &quot;You&quot; throughout this License, whether in upper or lower case, means an individual or a legal entity exercising rights under, and complying with all of the terms of, this License. For legal entities, &quot;You&quot; includes any entity that controls, is controlled by, or is under common control with you. For purposes of this definition, &quot;control&quot; means (i) the power, direct or indirect, to cause the direction or management of such entity, whether by contract or otherwise, or (ii) ownership of fifty percent (50%) or more of the outstanding shares, or (iii) beneficial ownership of such entity.</p>
                        <p>15) <strong>Right to Use.</strong> You may use the Original Work in all ways not otherwise restricted or conditioned by this License or by law, and Licensor promises not to interfere with or be responsible for such uses by You.</p>
                        <p>16) <strong>Modification of This License.</strong> This License is Copyright © 2005 Lawrence Rosen. Permission is granted to copy, distribute, or communicate this License without modification. Nothing in this License permits You to modify this License as applied to the Original Work or to Derivative Works. However, You may modify the text of this License and copy, distribute or communicate your modified version (the &quot;Modified License&quot;) and apply it to other original works of authorship subject to the following conditions: (i) You may not indicate in any way that your Modified License is the &quot;Open Software License&quot; or &quot;OSL&quot; and you may not use those names in the name of your Modified License; (ii) You must replace the notice specified in the first paragraph above with the notice &quot;Licensed under &lt;insert your license name here&gt;&quot; or with a notice of your own that is not confusingly similar to the notice in this License; and (iii) You may not claim that your original works are open source software unless your Modified License has been approved by Open Source Initiative (OSI) and You comply with its license review and certification process.
                            <br>
                        </div>
                            <a style="float: right;" href="#" title="Close" class="button-primary button button-large button-next">Close</a>
                        </p>

                    </div>
                </div>
                <input id="Acceptme" class="input-checkbox" type="checkbox">
            <label for="Acceptme">I accept the <a href="#openModal">License Agreement</a></label>
            </div>
            <br>
            <p class="wc-setup-actions step">
                <a href="{!! route('prerequisites') !!}"><input type="submit" id="submitme" class="button-primary button button-large button-next" value="Continue" name="accept1"></a>
                <input type="submit" class="button button-large button-next" value="Cancel" style="float: left">
            </p>
        </form>

    <script>
        var second = document.getElementById('Acceptme').checked = false;
        var first = document.getElementById('submitme').disabled = true;
        var checkme = document.getElementById('Acceptme');
        var submiter = document.getElementById('submitme');

        checkme.onchange = function() {
            submiter.disabled = !this.checked;
            if (submiter.disabled) {
                //    alert("Click to enable the button");
            };
        };
    </script>
    

@stop