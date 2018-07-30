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
                <title>OrderCatalog.xsl</title>
            </head>
            <body>
                <table border="1" width="680px" style="border-bottom:0" >
                    <tr>
                        <th style="width:5%;text-align:center">No.</th>
                        <th style="padding:10px 10px 10px 10px;width:70%">Product</th>
                        <th style="padding:10px 10px 10px 10px;width:20%">Action</th>
                    </tr>
                </table>
                <div style="height:470px;overflow-y:scroll">
                    <table border="1" width="680px" style="border-top:0" >
                        <xsl:for-each select="OrderCatalog/product">
                            <form action='orderPage.php' method="post">
                                <tr style="height:90px">
                                    <td style="width:5%;text-align:center">
                                        <xsl:value-of select="position()"/>
                                        <input type="hidden" name="id">
                                            <xsl:attribute name="value">
                                                <xsl:value-of select="id"/>
                                            </xsl:attribute>
                                        </input>
                                    </td>
                                    <td style="padding:5px 10px 10px 10px;width:70%">
                                        <b>
                                            <input type="hidden" name="name">
                                                <xsl:attribute name="value">
                                                    <xsl:value-of select="name"/>
                                                </xsl:attribute>
                                            </input>
                                            <span>Name: </span> 
                                        </b>  
                                        <xsl:value-of select="name"/>
                                        <br/>
                                        <b>
                                            <input type="hidden" name="description">
                                                <xsl:attribute name="value">
                                                    <xsl:value-of select="name"/>
                                                </xsl:attribute>
                                            </input>
                                            <span>Description: </span> 

                                        </b>                                 
                                        <xsl:value-of select="description"/>
                                        <br/>
                                        <b>
                                            <input type="hidden" name="price">
                                                <xsl:attribute name="value">
                                                    <xsl:value-of select="name"/>
                                                </xsl:attribute>
                                            </input>
                                            <span>Price: </span> 

                                        </b>   
                                        RM <xsl:value-of select="price"/>    
                                    </td>                     
                                    <td style="padding:5px 0 10px 0;width:20%;text-align:center">
                                        <label for="quantity">Qty: </label>
                                        <input type="text" name="quantity" style="width:30px;margin-bottom:10px"/>
                                        <br/>
                                        <input type="submit" name="add" value="Add to Cart"/>
                                    </td>
                                </tr>
                            </form>
                        </xsl:for-each>
                    </table>
                </div>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>
