using System;
using System.Data;
using System.IO;
using System.Xml;
using System.Xml.Serialization;
using MySql.Data;
using MySql.Data.MySqlClient;
namespace ConsoleApplication3
{
    internal class Program:NewDataSet
    {
        public static void Main(string[] args)
        {
            Program myPro = new Program();
            //OurXml oX = new OurXml();
            
            string connStr = "server=localhost;user=moseskaranja;database=tester;port=3306;password=Moses18.";
           
            MySqlConnection conn = new MySqlConnection(connStr);
            try
            {
                Console.WriteLine("Connecting to MySQL..... ");
                conn.Open();

                String sql = "SELECT  * FROM mpesadata";
                //MySqlCommand cmd = new MySqlCommand(sql,conn);
                MySqlDataAdapter da = new MySqlDataAdapter(sql,conn);
                //MySqlDataReader rdr = cmd.ExecuteReader();
                //int item = 0;
                
                /*while (rdr.Read())
                {
                    Console.WriteLine(rdr[0]);
                    Console.WriteLine(rdr[1]);
                    Console.WriteLine(rdr[2]);
                    Console.WriteLine(rdr[3]);
                    Console.WriteLine(rdr[4]);
                    Console.WriteLine(rdr[5]);
                    Console.WriteLine(rdr[6]);
                    
                    
                }*/
                
                DataSet ds = new DataSet();
                //fill dataset
                da.Fill(ds,"mpesadata");
                ds.WriteXml("newOutputFIle.xml");
                
                
                
                /*XmlSerializer desSerializer = new XmlSerializer(typeof(NewDataSet));
                TextReader reader = new StreamReader("OurOutputFIle.xml");
                object obj = desSerializer.Deserialize(reader);
                Console.WriteLine("Our object");
                Console.WriteLine(obj);
            
                mpesadata xmlData = (mpesadata) obj;
                
                NewDataSet xmlDatat = (NewDataSet)obj;
                Console.WriteLine("Our xml data");
                Console.WriteLine(xmlDatat);*/
                
                
                /*
                int idNum = xmlDatat.mpesadataList[0].IdNumber;
                String fname = xmlDatat.mpesadataList[0].FName;
                String lName = xmlDatat.mpesadataList[0].LName;
                Double amt = xmlDatat.mpesadataList[0].Amount;
                Double fulAmt = xmlDatat.mpesadataList[0].FulizaAmount;
                Double mshAmt = xmlDatat.mpesadataList[0].mshwariAmount;
                Double jahaAmt = xmlDatat.mpesadataList[0].okoaJahaziAmount;
                */
                
                
                
                /*
                Console.WriteLine(fname);
                Console.WriteLine(lName);
                Console.WriteLine(amt);
                */
                
                //reader.Close();
                
                XmlRootAttribute xRoot = new XmlRootAttribute();
                xRoot.ElementName = "NewDataSet";
                xRoot.IsNullable = true;
                
                /*
                mpesadata md = null;
                string path = "OurOutputFIle.xml";
                XmlSerializer deserializer = new XmlSerializer(typeof(mpesadata), xRoot);
                StreamReader rd = new StreamReader(path);
                md = (mpesadata)deserializer.Deserialize(rd);
                object obj = deserializer.Deserialize(rd);
                NewDataSet nData = (NewDataSet) obj;
                Console.WriteLine("Serialized object");

                Console.WriteLine(nData.mDataList);
                Console.WriteLine(md.FName);
                Console.WriteLine(md.LName);
                Console.WriteLine(md.Amount);
                Console.WriteLine(md.FulizaAmount);
                Console.WriteLine(md.mshwariAmount);
                Console.WriteLine(md.okoaJahaziAmount);
                */
                
                
                
                XmlSerializer deserializer = new XmlSerializer(typeof(NewDataSet));
                TextReader rd = new StreamReader("OurOutputFIle.xml");
                object obj = deserializer.Deserialize(rd);

                NewDataSet newDt = (NewDataSet) obj;
                
                Console.WriteLine(newDt.mDataList[0].IdNumber);
                Console.WriteLine(newDt.mDataList[0].FName);
                Console.WriteLine(newDt.mDataList[0].LName);
                Console.WriteLine(newDt.mDataList[0].FulizaAmount);
                Console.WriteLine(newDt.mDataList[0].okoaJahaziAmount);
                
                

                rd.Close();
   


                //NewDataSet XmlData = (NewDataSet)obj;












                /*
                myPro.deserializeXML();
                
                Console.WriteLine(myPro.IdNumber);
                Console.WriteLine(myPro.FName);
                Console.WriteLine(myPro.LName);
                Console.WriteLine(myPro.Amount);
                Console.WriteLine(myPro.FulizaAmount);
                Console.WriteLine(myPro.mshwariAmount);
                Console.WriteLine(myPro.okoaJahaziAmount);
                */


                //myPro.SerializeDesrialize();

                /*
                while (rdr.HasRows)
                {
                    rdr.Read();
                    item = item + 1;
                    Console.WriteLine(rdr[item]);

                }
                */


                /*foreach (String itemValue in rdr)
                {
                    Console.WriteLine(itemValue);
                    
                }*/

                //rdr.Close();


            }
            catch (Exception e)
            {
                Console.WriteLine(e);
                //throw;  
            }    
            conn.Close();
            Console.WriteLine("DONE...");
            
                
                
                
            /*
            Console.WriteLine("Hello world");
            
            XmlTextReader textReader = new XmlTextReader("books.xml");
            myPro.OutputToConsole();
            */





        }
    }

    /*
    internal class MySqlConnection
    {
        public MySqlConnection(string connStr)
        {
            throw new NotImplementedException();
        }
    }*/
    
    
}