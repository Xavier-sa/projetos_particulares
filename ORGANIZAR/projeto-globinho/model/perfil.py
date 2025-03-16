# -*- coding: utf-8 -*-

################################################################################
## Form generated from reading UI file 'perfiltTKCha.ui'
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

class Ui_Perfil_usuario(object):
    def setupUi(self, Perfil_usuario):
        if not Perfil_usuario.objectName():
            Perfil_usuario.setObjectName(u"Perfil_usuario")
        Perfil_usuario.resize(605, 607)
        self.label = QLabel(Perfil_usuario)
        self.label.setObjectName(u"label")
        self.label.setGeometry(QRect(50, 20, 100, 16))
        self.label.setStyleSheet(u"color: red;\n"
"font: bold 14px;\n"
"")
        self.label.setTextFormat(Qt.TextFormat.AutoText)
        self.label_username = QLabel(Perfil_usuario)
        self.label_username.setObjectName(u"label_username")
        self.label_username.setGeometry(QRect(150, 20, 200, 16))
        self.label_life = QLabel(Perfil_usuario)
        self.label_life.setObjectName(u"label_life")
        self.label_life.setGeometry(QRect(130, 310, 49, 16))
        self.label_life_value = QLabel(Perfil_usuario)
        self.label_life_value.setObjectName(u"label_life_value")
        self.label_life_value.setGeometry(QRect(150, 60, 100, 16))
        self.label_ki = QLabel(Perfil_usuario)
        self.label_ki.setObjectName(u"label_ki")
        self.label_ki.setGeometry(QRect(130, 350, 49, 16))
        self.label_ki_value = QLabel(Perfil_usuario)
        self.label_ki_value.setObjectName(u"label_ki_value")
        self.label_ki_value.setGeometry(QRect(150, 100, 100, 16))
        self.label_forca = QLabel(Perfil_usuario)
        self.label_forca.setObjectName(u"label_forca")
        self.label_forca.setGeometry(QRect(130, 390, 261, 16))
        self.label_forca_value = QLabel(Perfil_usuario)
        self.label_forca_value.setObjectName(u"label_forca_value")
        self.label_forca_value.setGeometry(QRect(150, 150, 100, 16))
        self.pushButton = QPushButton(Perfil_usuario)
        self.pushButton.setObjectName(u"pushButton")
        self.pushButton.setGeometry(QRect(320, 570, 75, 24))
        self.label_2 = QLabel(Perfil_usuario)
        self.label_2.setObjectName(u"label_2")
        self.label_2.setGeometry(QRect(80, 50, 221, 181))
        self.label_2.setInputMethodHints(Qt.InputMethodHint.ImhUppercaseOnly)
        self.label_2.setPixmap(QPixmap(u"./images/joagdo.PNG"))
        self.label_2.setMargin(0)
        self.label_2.setIndent(-4)

        self.retranslateUi(Perfil_usuario)

        QMetaObject.connectSlotsByName(Perfil_usuario)
    # setupUi

    def retranslateUi(self, Perfil_usuario):
        Perfil_usuario.setWindowTitle(QCoreApplication.translate("Perfil_usuario", u"Perfil do Usu\u00e1rio", None))
        self.label.setText(QCoreApplication.translate("Perfil_usuario", u"Usu\u00e1rio:", None))
        self.label_username.setText("")
        self.label_life.setText(QCoreApplication.translate("Perfil_usuario", u"Life:", None))
        self.label_life_value.setText("")
        self.label_ki.setText(QCoreApplication.translate("Perfil_usuario", u"Ki:", None))
        self.label_ki_value.setText("")
        self.label_forca.setText(QCoreApplication.translate("Perfil_usuario", u"For\u00e7a:", None))
        self.label_forca_value.setText("")
        self.pushButton.setText(QCoreApplication.translate("Perfil_usuario", u"Voltar", None))
        self.label_2.setText("")
    # retranslateUi

