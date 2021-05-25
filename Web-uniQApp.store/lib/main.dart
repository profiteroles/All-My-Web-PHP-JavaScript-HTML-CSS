import 'package:flutter/material.dart';
import 'package:uniqappstore/screen/terms.dart';

void main() => runApp(MyApp());

class MyApp extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      title: 'uniQ App Store Terms',
      theme: ThemeData(
        primarySwatch: Colors.blue,
      ),
      home: TermsPage(),
    );
  }
}
/*
class MyHomePage extends StatefulWidget {
  @override
  _MyHomePageState createState() => _MyHomePageState();
}

String kBackImage = 'images/construction.png';

class _MyHomePageState extends State<MyHomePage> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.lightBlue.withOpacity(0.8),
      body: SingleChildScrollView(
        child: Column(
          children: <Widget>[
            Container(
              width: double.infinity,
              child: Container(
                color: Colors.orange[900].withOpacity(0.2),
                child: Text(
                    'Thank you for visiting us\nWe are currently doing some work on site',
                    textAlign: TextAlign.center,
                    style: GoogleFonts.lora().copyWith(
                      fontSize: 50,
                      color: Colors.black87.withOpacity(0.75),
                      fontWeight: FontWeight.bold,
                    )),
              ),
            ),
            Stack(
              children: [
                Container(child: Image.asset(kBackImage)),
                Container(
                  height: MediaQuery.of(context).size.height * 0.96,
                  decoration: (BoxDecoration(
                    gradient: LinearGradient(
                      colors: [
                        Colors.orange[900].withOpacity(0.2),
                        Colors.yellow[700].withOpacity(0.8),
                      ],
                      begin: Alignment.topCenter,
                      end: Alignment.bottomCenter,
                    ),
                  )),
                ),
              ],
            ),
            Container(
              width: double.infinity,
              color: Colors.yellow[700].withOpacity(0.8),
              child: Row(
                mainAxisAlignment: MainAxisAlignment.center,
                children: [
                  Text(
                    'Thank you for your patience\n\n'
                    'We currently under new construction\n\n\n'
                    'Please feel free to email us on my@uniqapp.stor'
                    '\n\n\nCopyright © 2021 uniQ App Store®\n\n',
                    textAlign: TextAlign.center,
                    style: GoogleFonts.lora()
                        .copyWith(fontSize: 15, fontWeight: FontWeight.w400),
                  ),
                  TextButton(
                      onPressed: () => Navigator.push(context,
                          MaterialPageRoute(builder: (context) => TermsPage())),
                      child: Text(
                        'e                          ',
                        textAlign: TextAlign.start,
                        style: GoogleFonts.lora().copyWith(color: Colors.black),
                      ))
                ],
              ),
            ),
          ],
        ),
      ),
    );
  }
  
}
*/
