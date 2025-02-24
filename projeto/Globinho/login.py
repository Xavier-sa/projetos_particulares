# -*- coding: utf-8 -*-

################################################################################
## Form generated from reading UI file 'loginowPzkB.ui'
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
from PySide6.QtWidgets import (QApplication, QDialog, QGridLayout, QLabel,
    QLineEdit, QPushButton, QSizePolicy, QWidget)

class Ui_Dialog(object):
    def setupUi(self, Dialog):
        if not Dialog.objectName():
            Dialog.setObjectName(u"Dialog")
        Dialog.resize(632, 560)
        self.layoutWidget = QWidget(Dialog)
        self.layoutWidget.setObjectName(u"layoutWidget")
        self.layoutWidget.setGeometry(QRect(20, 30, 605, 509))
        self.gridLayout = QGridLayout(self.layoutWidget)
        self.gridLayout.setObjectName(u"gridLayout")
        self.gridLayout.setContentsMargins(0, 0, 0, 0)
        self.alogo = QLabel(self.layoutWidget)
        self.alogo.setObjectName(u"alogo")
        self.alogo.setPixmap(QPixmap(u"logo.JPG"))

        self.gridLayout.addWidget(self.alogo, 0, 0, 1, 1)

        self.lineEdit_user = QLineEdit(self.layoutWidget)
        self.lineEdit_user.setObjectName(u"lineEdit_user")

        self.gridLayout.addWidget(self.lineEdit_user, 1, 0, 1, 2)

        self.lineEdit_password = QLineEdit(self.layoutWidget)
        self.lineEdit_password.setObjectName(u"lineEdit_password")
        self.lineEdit_password.setEchoMode(QLineEdit.EchoMode.Password)

        self.gridLayout.addWidget(self.lineEdit_password, 2, 0, 1, 2)

        self.btn_login = QPushButton(self.layoutWidget)
        self.btn_login.setObjectName(u"btn_login")

        self.gridLayout.addWidget(self.btn_login, 3, 0, 1, 2)


        self.retranslateUi(Dialog)

        QMetaObject.connectSlotsByName(Dialog)
    # setupUi

    def retranslateUi(self, Dialog):
        Dialog.setWindowTitle(QCoreApplication.translate("Dialog", u"Login", None))
        self.lineEdit_user.setPlaceholderText(QCoreApplication.translate("Dialog", u"Digite seu usu\u00e1rio", None))
        self.lineEdit_password.setPlaceholderText(QCoreApplication.translate("Dialog", u"Digite sua senha", None))
        self.btn_login.setText(QCoreApplication.translate("Dialog", u"Entrar", None))
    # retranslateUi

