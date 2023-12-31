import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:qr_scan/providers/scan_list_provider.dart';
import 'package:qr_scan/utils/utils.dart';
import 'package:flutter_barcode_scanner/flutter_barcode_scanner.dart';
import '../models/scan_model.dart';
import '../providers/db_provider.dart';

class ScanButton extends StatelessWidget {
  const ScanButton({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return FloatingActionButton(
      elevation: 0,
      child: Icon(
        Icons.filter_center_focus,
      ),
      onPressed: () async {
        print('Botó polsat!');
        // String barcodeScanRes = 'http://paucasesnovescifp.cat/';
        String barcodeScanRes = 'geo:39.7260888,2.9113035';
        // String barcodeScanRes = await FlutterBarcodeScanner.scanBarcode(
        //     '#3D8BEF', 'Cancel·lar', false, ScanMode.QR);

        final scanListProvider =
            Provider.of<ScanListProvider>(context, listen: false);
        ScanModel nouScan = ScanModel(valor: barcodeScanRes);
        scanListProvider.nouScan(barcodeScanRes);
        launchUrl(context, nouScan);
      },
    );
  }
}
