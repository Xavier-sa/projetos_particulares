# -*- coding: utf-8 -*-

################################################################################
## Form generated from reading UI file 'designerzfJthv.ui'
##
## Created by: Qt User Interface Compiler version 6.7.2
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
from PySide6.QtWidgets import (QApplication, QCheckBox, QColumnView, QCommandLinkButton,
    QDialog, QLabel, QPushButton, QSizePolicy,
    QWidget)

class Ui_Dialog(object):
    def setupUi(self, Dialog):
        if not Dialog.objectName():
            Dialog.setObjectName(u"Dialog")
        Dialog.resize(474, 626)
        Dialog.setSizeGripEnabled(True)
        Dialog.setModal(False)
        self.widget = QWidget(Dialog)
        self.widget.setObjectName(u"widget")
        self.widget.setGeometry(QRect(90, 40, 261, 541))
        self.checkBox = QCheckBox(self.widget)
        self.checkBox.setObjectName(u"checkBox")
        self.checkBox.setGeometry(QRect(40, 240, 151, 21))
        self.widget_2 = QWidget(self.widget)
        self.widget_2.setObjectName(u"widget_2")
        self.widget_2.setGeometry(QRect(190, 460, 271, 551))
        self.checkBox_2 = QCheckBox(self.widget_2)
        self.checkBox_2.setObjectName(u"checkBox_2")
        self.checkBox_2.setGeometry(QRect(30, 330, 151, 21))
        self.commandLinkButton = QCommandLinkButton(self.widget)
        self.commandLinkButton.setObjectName(u"commandLinkButton")
        self.commandLinkButton.setGeometry(QRect(30, 410, 186, 41))
        self.label_3 = QLabel(self.widget)
        self.label_3.setObjectName(u"label_3")
        self.label_3.setGeometry(QRect(50, 100, 121, 41))
        self.label_3.setIndent(11)
        self.label = QLabel(self.widget)
        self.label.setObjectName(u"label")
        self.label.setGeometry(QRect(50, 140, 131, 31))
        self.columnView = QColumnView(self.widget)
        self.columnView.setObjectName(u"columnView")
        self.columnView.setGeometry(QRect(30, 140, 161, 31))
        self.label_2 = QLabel(self.widget)
        self.label_2.setObjectName(u"label_2")
        self.label_2.setGeometry(QRect(40, 190, 131, 21))
        self.columnView_2 = QColumnView(self.widget)
        self.columnView_2.setObjectName(u"columnView_2")
        self.columnView_2.setGeometry(QRect(30, 190, 161, 31))
        self.pushButton_2 = QPushButton(self.widget)
        self.pushButton_2.setObjectName(u"pushButton_2")
        self.pushButton_2.setGeometry(QRect(30, 280, 181, 41))
        self.pushButton = QPushButton(self.widget)
        self.pushButton.setObjectName(u"pushButton")
        self.pushButton.setGeometry(QRect(30, 340, 181, 41))
        self.columnView_2.raise_()
        self.columnView.raise_()
        self.checkBox.raise_()
        self.widget_2.raise_()
        self.commandLinkButton.raise_()
        self.label_3.raise_()
        self.label.raise_()
        self.label_2.raise_()
        self.pushButton_2.raise_()
        self.pushButton.raise_()

        self.retranslateUi(Dialog)

        QMetaObject.connectSlotsByName(Dialog)
    # setupUi

    def retranslateUi(self, Dialog):
        Dialog.setWindowTitle(QCoreApplication.translate("Dialog", u"Dialog", None))
        self.checkBox.setText(QCoreApplication.translate("Dialog", u"Lembrar e-mail", None))
        self.checkBox_2.setText(QCoreApplication.translate("Dialog", u"Lembrar e-mail", None))
        self.commandLinkButton.setText(QCoreApplication.translate("Dialog", u"Recuperar a Senha", None))
        self.label_3.setText(QCoreApplication.translate("Dialog", u"Bem Vindo ", None))
        self.label.setText(QCoreApplication.translate("Dialog", u"E-mail", None))
        self.label_2.setText(QCoreApplication.translate("Dialog", u"Senha", None))
        self.pushButton_2.setText(QCoreApplication.translate("Dialog", u"Logar", None))
        self.pushButton.setText(QCoreApplication.translate("Dialog", u"Registrar-se", None))
    # retranslateUi

