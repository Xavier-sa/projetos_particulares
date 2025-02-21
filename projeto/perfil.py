# -*- coding: utf-8 -*-

################################################################################
## Form generated from reading UI file 'perfil.ui'
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
from PySide6.QtWidgets import (QApplication, QDialog, QLabel, QPushButton,
    QSizePolicy, QWidget)

class Ui_PerfilWindow(object):
    def setupUi(self, Dialog):
        if not Dialog.objectName():
            Dialog.setObjectName(u"Dialog")
        Dialog.resize(400, 300)
        self.label = QLabel(Dialog)
        self.label.setObjectName(u"label")
        self.label.setGeometry(QRect(40, 20, 100, 16))
        self.label_username = QLabel(Dialog)
        self.label_username.setObjectName(u"label_username")
        self.label_username.setGeometry(QRect(150, 20, 200, 16))
        self.label_life = QLabel(Dialog)
        self.label_life.setObjectName(u"label_life")
        self.label_life.setGeometry(QRect(50, 60, 49, 16))
        self.label_life_value = QLabel(Dialog)
        self.label_life_value.setObjectName(u"label_life_value")
        self.label_life_value.setGeometry(QRect(150, 60, 100, 16))
        self.label_ki = QLabel(Dialog)
        self.label_ki.setObjectName(u"label_ki")
        self.label_ki.setGeometry(QRect(50, 100, 49, 16))
        self.label_ki_value = QLabel(Dialog)
        self.label_ki_value.setObjectName(u"label_ki_value")
        self.label_ki_value.setGeometry(QRect(150, 100, 100, 16))
        self.label_forca = QLabel(Dialog)
        self.label_forca.setObjectName(u"label_forca")
        self.label_forca.setGeometry(QRect(50, 150, 49, 16))
        self.label_forca_value = QLabel(Dialog)
        self.label_forca_value.setObjectName(u"label_forca_value")
        self.label_forca_value.setGeometry(QRect(150, 150, 100, 16))
        self.pushButton = QPushButton(Dialog)
        self.pushButton.setObjectName(u"pushButton")
        self.pushButton.setGeometry(QRect(150, 230, 75, 24))

        self.retranslateUi(Dialog)

        QMetaObject.connectSlotsByName(Dialog)
    # setupUi

    def retranslateUi(self, Dialog):
        Dialog.setWindowTitle(QCoreApplication.translate("Dialog", u"Perfil do Usu\u00e1rio", None))
        self.label.setText(QCoreApplication.translate("Dialog", u"Usu\u00e1rio:", None))
        self.label_username.setText("")
        self.label_life.setText(QCoreApplication.translate("Dialog", u"Life:", None))
        self.label_life_value.setText("")
        self.label_ki.setText(QCoreApplication.translate("Dialog", u"Ki:", None))
        self.label_ki_value.setText("")
        self.label_forca.setText(QCoreApplication.translate("Dialog", u"For\u00e7a:", None))
        self.label_forca_value.setText("")
        self.pushButton.setText(QCoreApplication.translate("Dialog", u"Voltar", None))
    # retranslateUi

