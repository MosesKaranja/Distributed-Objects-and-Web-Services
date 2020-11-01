using System;
using System.Collections.Generic;
using System.IO;
using System.Xml.Serialization;

namespace ConsoleApplication3
{
    
    [Serializable()]
    [XmlRoot("NewDataSet")]
    //[XmlRootAttribute("NewDataSet")]
    
    public class NewDataSet
    {
        //[XmlElement("mpesadata")]
        //public List<mpesadata> mpesadataList = new List<mpesadata>();
        
        /*
        XmlSerializer deserializer = new XmlSerializer(typeof(NewDataSet));
        TextReader reader = new StreamReader("newOutputFIle.xml");
        Object obj = deserializer.Deserialize(reader);
        private NewDataSet xmlData = (NewDataSet) obj;
        reader.close();
        */
        
        

        /*
        [XmlArray("NewDataSet")]
        [XmlArrayItem("mpesadata")]
        public mpesadata[] nd { get; set; }
        */
        
        
        [XmlElement("mpesadata")]
        public List<mpesadata> mDataList = new List<mpesadata>();



    }
    
    [Serializable()]
    public class mpesadata
    {
        [XmlElement("IdNumber")]
        public int IdNumber { get; set; }
        
        [XmlElement("FName")]
        public String FName { get; set; }
        
        [XmlElement("LName")]
        public String LName { get; set; }
        
        [XmlElement("Amount")]
        public Double Amount { get; set; }
        
        [XmlElement("FulizaAmount")]
        public Double FulizaAmount { get; set; }
        
        [XmlElement("mshwariAmount")]
        public Double mshwariAmount { get; set; }
        
        [XmlElement("okoaJahaziAmount")]
        public Double okoaJahaziAmount { get; set; }

        /*public mpesadata()
        {
            IdNumber = 0;
            FName = "None";
            LName = "None";
            Amount = 0;
            FulizaAmount = 0;
            mshwariAmount = 0;
            okoaJahaziAmount = 0;
            
        }*/

        /*static XmlSerializer deserializer = new XmlSerializer(typeof(NewDataSet));

        static TextReader reader = new StreamReader("newOutputFIle.xml");
        //Object obj = deserializer.Deserialize(reader);
        static object obj = deserializer.Deserialize(reader);
        private NewDataSet xmlData = (NewDataSet)obj;*/


        public void deserializeXML()
        {
            XmlSerializer desSerializer = new XmlSerializer(typeof(NewDataSet));
            TextReader reader = new StreamReader("OurOutputFIle.xml");
            Object obj = desSerializer.Deserialize(reader);
            Console.WriteLine("Our object");
            Console.WriteLine(obj);
            
            //mpesadata xmlData = (mpesadata) obj;
            reader.Close();

        }

    }
    
    
}
