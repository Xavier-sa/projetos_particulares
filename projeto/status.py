# -*- coding: utf-8 -*-

################################################################################
## Form generated from reading UI file 'status.ui'
##
## Created by: Qt User Interface Compiler version 6.8.2
##
## WARNING! All changes made in this file will be lost when recompiling UI file!
################################################################################

from PySide6.QtCore import (QCoreApplication, QDate, QDateTime, QLocale,
    QMetaObject, QObject, QPoint, QRect,
    QSize, QTime, QUrl, Qt)
from PySide6.QtGui import (QBrush, QColor, QConicalGradient, QCursor,
    QFont, QFontDatabase, QGradient, QIcon,
    QImage, QKeySequence, QLinearGradient, QPainter,
    QPalette, QPixmap, QRadialGradient, QTransform)
from PySide6.QtWidgets import (QApplication, QDialog, QLabel, QLineEdit,
    QPushButton, QSizePolicy, QWidget)

class Ui_StatusWindoW(object):
    def setupUi(self, StatusWindoW):
        if not StatusWindoW.objectName():
            StatusWindoW.setObjectName(u"StatusWindoW")
        StatusWindoW.resize(305, 522)
        self.label = QLabel(StatusWindoW)
        self.label.setObjectName(u"label")
        self.label.setGeometry(QRect(40, 90, 341, 61))
        self.label_2 = QLabel(StatusWindoW)
        self.label_2.setObjectName(u"label_2")
        self.label_2.setGeometry(QRect(110, 150, 49, 16))
        self.lineEdit = QLineEdit(StatusWindoW)
        self.lineEdit.setObjectName(u"lineEdit")
        self.lineEdit.setGeometry(QRect(80, 150, 113, 22))
        self.label_3 = QLabel(StatusWindoW)
        self.label_3.setObjectName(u"label_3")
        self.label_3.setGeometry(QRect(110, 190, 49, 16))
        self.label_4 = QLabel(StatusWindoW)
        self.label_4.setObjectName(u"label_4")
        self.label_4.setGeometry(QRect(110, 230, 49, 16))
        self.lineEdit_ki = QLineEdit(StatusWindoW)
        self.lineEdit_ki.setObjectName(u"lineEdit_ki")
        self.lineEdit_ki.setGeometry(QRect(80, 190, 113, 22))
        self.lineEdit_forca = QLineEdit(StatusWindoW)
        self.lineEdit_forca.setObjectName(u"lineEdit_forca")
        self.lineEdit_forca.setGeometry(QRect(80, 230, 113, 22))
        self.label_5 = QLabel(StatusWindoW)
        self.label_5.setObjectName(u"label_5")
        self.label_5.setGeometry(QRect(40, 20, 161, 81))
        self.label_5.setPixmap(QPixmap(u"x.jpg"))
        self.pushButton = QPushButton(StatusWindoW)
        self.pushButton.setObjectName(u"pushButton")
        self.pushButton.setGeometry(QRect(80, 300, 75, 24))
        self.lineEdit_ki.raise_()
        self.lineEdit_forca.raise_()
        self.lineEdit.raise_()
        self.label.raise_()
        self.label_2.raise_()
        self.label_3.raise_()
        self.label_4.raise_()
        self.label_5.raise_()
        self.pushButton.raise_()

        self.retranslateUi(StatusWindoW)

        QMetaObject.connectSlotsByName(StatusWindoW)
    # setupUi

    def retranslateUi(self, StatusWindoW):
        StatusWindoW.setWindowTitle(QCoreApplication.translate("StatusWindoW", u"Dialog", None))
        self.label.setText(QCoreApplication.translate("StatusWindoW", u"Adicione Pontos!", None))
        self.label_2.setText(QCoreApplication.translate("StatusWindoW", u"Life", None))
        self.label_3.setText(QCoreApplication.translate("StatusWindoW", u"KI", None))
        self.label_4.setText(QCoreApplication.translate("StatusWindoW", u"Forca", None))
        self.label_5.setText("")
        self.pushButton.setText(QCoreApplication.translate("StatusWindoW", u"Enviar", None))
    # retranslateUi

