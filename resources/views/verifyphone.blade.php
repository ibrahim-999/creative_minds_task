@extends('layouts.app')
@section('content')
    <DIV CLASS="CONTAINER">
        <DIV CLASS="ROW JUSTIFY-CONTENT-CENTER">
            <DIV CLASS="COL-MD-8">
                @if (session('status'))
                    <DIV CLASS="ALERT ALERT-SUCCESS" ROLE="ALERT">
                        {{ session('status') }}
                    </DIV>
                @endif
                <DIV CLASS="CARD">
                    <DIV CLASS="CARD-HEADER">Verify your phone</DIV>
                    <DIV CLASS="CARD-BODY">
                        <P>Thanks for registering with our platform. We will call you to verify your phone number in a jiffy. Provide the code below.</P>

                        <DIV CLASS="D-FLEX JUSTIFY-CONTENT-CENTER">
                            <DIV CLASS="COL-8">
                                <FORM METHOD="POST" ACTION="{{ ROUTE('PHONEVERIFICATION.VERIFY') }}">
                                    @csrf
                                    <DIV CLASS="FORM-GROUP">
                                        <LABEL FOR="CODE">Verification Code</LABEL>
                                        <INPUT ID="CODE" CLASS="FORM-CONTROL{{ $ERRORS->HAS('CODE') ? ' IS-INVALID' : '' }}" NAME="CODE" TYPE="TEXT" PLACEHOLDER="VERIFICATION CODE" REQUIRED AUTOFOCUS>
                                        @if ($errors->has('code'))
                                            <SPAN CLASS="INVALID-FEEDBACK" ROLE="ALERT">
                                                    <STRONG>{{ $errors->first('code') }}</STRONG>
                                                </SPAN>
                                        @endif
                                    </DIV>
                                    <DIV CLASS="FORM-GROUP">
                                        <BUTTON CLASS="BTN BTN-PRIMARY">Verify Phone</BUTTON>
                                    </DIV>
                                </FORM>
                            </DIV>
                        </DIV>
                    </DIV>
                </DIV>
            </DIV>
        </DIV>
    </DIV>
@endsection
