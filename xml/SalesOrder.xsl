<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : SalesOrder.xsl
    Created on : July 29, 2018, 12:22 PM
    Author     : Chun Ming
    Description:
        Purpose of transformation follows.
-->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="html"/>

    <!-- TODO customize transformation rules 
         syntax recommendation http://www.w3.org/TR/xslt 
    -->
    <xsl:template match="/">
        <html>
            <head>
                <title>Sales Order</title>
            </head>
            <body>
                <div style='margin:auto;width:55%;'>
                    <xsl:variable name="shipMethod" select="SalesOrder/shipMethod"/>
                    <h2 style='text-align:center;margin:auto;font-weight:650;margin-bottom:20px;width:300px'>
                        <u>Sales Order</u>
                    </h2>
                    <div class="row">
                        <div class="col s2" style="text-align:right">
                            <b>Order No:</b>
                        </div>
                        <div class="col s3">
                            #<xsl:value-of select="SalesOrder/orderID"/>
                        </div>
                        <div class="col s2" style="text-align:right">
                            <b>To : </b>
                        </div>
                        <div class="col s5">
                            <xsl:value-of select="SalesOrder/to/custName"/>
                            (<xsl:value-of select="SalesOrder/to/custEmail"/>)
                        </div>
                    </div>

                    <div class="row">
                        <div class="col s2" style="text-align:right">
                            <b>Shipping Method : </b> 
                        </div>
                        <xsl:choose>
                            <xsl:when test="$shipMethod = 1">
                                <div class="col s3">
                                    Pickup
                                </div>
                            </xsl:when>
                            <xsl:otherwise>
                                <div class="col s3">
                                    Delivery
                                </div>
                            </xsl:otherwise>
                        </xsl:choose>
                        <div class="col s2" style="text-align:right">
                            <b>Order Date : </b>
                        </div>
                        <div class="col s5">
                            <xsl:value-of select="SalesOrder/orderDate"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s2" style="text-align:right">
                            <xsl:choose>
                                <xsl:when test="$shipMethod = 1">
                                    <b>Pickup Date : </b>
                                </xsl:when>
                                <xsl:otherwise>
                                    <b>Delivery Date : </b>
                                </xsl:otherwise>
                            </xsl:choose>
                        </div>
                        <div class="col s3">
                            <xsl:value-of select="SalesOrder/shipDate"/>
                        </div>
                        <div class="col s2" style="text-align:right">
                            <xsl:choose>
                                <xsl:when test="$shipMethod = 1">
                                    <b>Pickup Time : </b>
                                </xsl:when>
                                <xsl:otherwise>
                                    <b>Delivery Time : </b>
                                </xsl:otherwise>
                            </xsl:choose>
                        </div>
                        <div class="col s5">
                            <xsl:value-of select="SalesOrder/shipTime"/>
                        </div>
                    </div>  
                    <div class="row">
                        <xsl:choose>
                            <xsl:when test="$shipMethod = 2">
                                <div class="col s2" style="text-align:right">
                                    <b>Delivery Address : </b>
                                </div>
                                <div class="col s10">
                                    <xsl:value-of select="SalesOrder/to/shipAddress"/>                                   
                                </div>
                            </xsl:when>
                        </xsl:choose>
                    </div>
                    <div style="width:100%;min-height:500px;border:1px solid lightgrey;margin-top:20px;">
                        <table width="100%" style="table-layout:fixed" class="highlight">
                            <tr>
                                <th width="5%" style="text-align:center">No</th>
                                <th width="60%">Name &amp; Description</th>
                                <th width="12%">Unit Price(RM)</th>
                                <th width="8%" style='text-align:center'>Quantity</th>
                                <th width="15%">Total Amount(RM)</th>
                            </tr>
                            <xsl:for-each select="SalesOrder/product">
                                <tr>
                                    <td width="5%" style='text-align:center'>
                                        <xsl:value-of select="no"/>
                                    </td>
                                    <td width="60%">
                                        <div>
                                            <xsl:value-of select="name"/> - <xsl:value-of select="description"/>
                                        </div>
                                    </td>
                                    <td width="12%" style='text-align:right;padding-right:20px'>
                                        <xsl:value-of select="format-number(price, '#.00')"/>                            
                                    </td>
                                    <td width="8%" style='text-align:center'>
                                        <xsl:value-of select="quantity"/>
                                    </td>
                                    <td width="15%" style='text-align:right;padding-right:20px'>
                                        <xsl:value-of select="format-number(totalAmount, '#.00')"/>
                                    </td>      
                                </tr>
                            </xsl:for-each>
                        </table>
                    </div>
                    <div class="row" style="margin-top:20px;padding-right:10px">
                        <div width='100%' class="col s10" style="text-align:right;font-size:20px">
                            <span>
                                <b>Grand Total (RM) : </b>
                            </span>
                        </div>
                        <div class="col s2" style="text-align:right;font-size:20px">
                            <xsl:value-of select="format-number(SalesOrder/grandTotal, '#.00')"/>
                        </div>
                    </div>
                </div>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>
