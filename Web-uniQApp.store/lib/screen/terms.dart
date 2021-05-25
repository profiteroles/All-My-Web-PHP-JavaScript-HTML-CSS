import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:uniqappstore/constants.dart';

class TermsPage extends StatelessWidget {
  List<Widget> _buildRow() {
    TextStyle headStyle = GoogleFonts.playfairDisplay().copyWith(
        color: Colors.white54, fontSize: 30, fontWeight: FontWeight.bold);

    TextStyle textStyle = GoogleFonts.playfairDisplay().copyWith(
        color: Colors.white54, fontSize: 20, fontWeight: FontWeight.w400);
    TextAlign alignment = TextAlign.center;
    List<Container> titles = [];
    for (int i = 0; i < headers.length; i++) {
      final con = Container(
        padding: EdgeInsets.symmetric(vertical: 10, horizontal: 30),
        child: Card(
          color: Colors.blueGrey,
          elevation: 20,
          shadowColor: Colors.black,
          child: Column(
            children: [
              Text(headers[i], textAlign: alignment, style: headStyle),
              Text(content[2], textAlign: alignment, style: textStyle),
            ],
          ),
        ),
      );
      titles.add(con);
    }
    return titles;
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.black26,
      body: SingleChildScrollView(
        child: Center(
          child: Column(
            children: [
              SizedBox(height: 30),
              Text(
                'uniQ App Store Terms & Conditions',
                textAlign: TextAlign.center,
                style: GoogleFonts.lora().copyWith(
                    color: Color(0xff3c86c2),
                    fontSize: 40,
                    fontWeight: FontWeight.bold),
              ),
              SizedBox(height: 20),
              Column(
                children: _buildRow(),
              ),
              SizedBox(height: 20),
            ],
          ),
        ),
      ),
    );
  }
}
